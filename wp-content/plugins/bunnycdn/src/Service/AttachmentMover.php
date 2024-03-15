<?php

// bunny.net WordPress Plugin
// Copyright (C) 2024  BunnyWay d.o.o.
//
// This program is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program.  If not, see <http://www.gnu.org/licenses/>.

declare(strict_types=1);

namespace Bunny\Wordpress\Service;

use Bunny\Storage\Client as StorageClient;
use Bunny\Wordpress\Config\Offloader as OffloaderConfig;
use GuzzleHttp\Promise;

class AttachmentMover
{
    private const WP_POSTMETA_ATTEMPTS_KEY = '_bunnycdn_offload_attempts';
    private const WP_POSTMETA_UPLOAD_LOCK_KEY = '_bunnycdn_upload_lock';
    private const LOCK_TIMEOUT_SECONDS = 60 * 15;

    private StorageClient $storage;
    private OffloaderConfig $config;

    public function __construct(StorageClient $storage, OffloaderConfig $config)
    {
        $this->storage = $storage;
        $this->config = $config;
    }

    /**
     * @return array{success: bool, data: array{message: string}}
     */
    public function perform(int $batchSize): array
    {
        if (!$this->config->isEnabled()) {
            return ['success' => false, 'data' => ['message' => 'The Offloader feature is disabled.']];
        }

        $this->releaseOldLocks();

        try {
            $results = $this->getAttachmentsAndLock($batchSize);
            $countResults = count($results);
        } catch (\Exception $e) {
            return ['success' => false, 'data' => ['message' => $e->getMessage()]];
        }

        if (0 === $countResults) {
            return ['success' => true, 'data' => ['message' => 'There are no files available to be moved.']];
        }

        $errors = [];

        foreach ($results as $row) {
            $postID = (int) $row['ID'];

            try {
                $this->moveAttachmentToCDN($postID);
            } catch (\Bunny\Storage\AuthenticationException $e) {
                return ['success' => false, 'data' => ['message' => 'Authentication to the storage failed. Make sure the Storage Zone and its password are correct.']];
            } catch (\Exception $e) {
                $attempts = (int) $row['attempts'];
                ++$attempts;
                update_post_meta($postID, self::WP_POSTMETA_ATTEMPTS_KEY, $attempts);

                $errors[] = $e->getMessage();
            }
        }

        $countErrors = count($errors);

        // all success
        if (0 === $countErrors) {
            return ['success' => true, 'data' => ['message' => sprintf('%d files moved to the BunnyCDN Storage.', $countResults)]];
        }

        // all error
        if ($countResults === $countErrors) {
            error_log(implode(PHP_EOL, $errors));

            return ['success' => false, 'data' => ['message' => 'Errors:'.PHP_EOL.PHP_EOL.implode(PHP_EOL, $errors)]];
        }

        // partial success
        error_log(implode(PHP_EOL, $errors));

        return ['success' => true, 'data' => ['message' => sprintf('%d files moved to the BunnyCDN Storage, however %d failed to be moved.'.PHP_EOL.PHP_EOL.'Errors:'.PHP_EOL.implode(PHP_EOL, $errors), $countResults, $countErrors)]];
    }

    /**
     * @return array<string, string>[]
     */
    private function getAttachmentsAndLock(int $limit): array
    {
        /** @var \wpdb */
        global $wpdb;

        $wpdb->query('START TRANSACTION');

        /** @var string $sql */
        $sql = $wpdb->prepare(
            'SELECT p.ID, pm2.meta_value AS attempts
                    FROM %i p
                    LEFT JOIN %i pm ON pm.post_id = p.ID AND pm.meta_key = "%s"
                    LEFT JOIN %i pm2 ON p.ID = pm2.post_id AND pm2.meta_key = "%s"
                    LEFT JOIN %i pm3 ON p.ID = pm3.post_id AND pm3.meta_key = "%s"
                    LEFT JOIN %i pm4 ON p.ID = pm4.post_id AND pm4.meta_key = "%s"
                    WHERE p.post_type = "attachment" AND pm.meta_key IS NULL AND pm3.meta_key IS NULL AND pm4.meta_key IS NULL
                    ORDER BY pm2.meta_value ASC, p.ID DESC
                    LIMIT %d
                    FOR UPDATE
            ',
            $wpdb->posts,
            $wpdb->postmeta,
            \Bunny\Wordpress\Offloader::WP_POSTMETA_KEY,
            $wpdb->postmeta,
            self::WP_POSTMETA_ATTEMPTS_KEY,
            $wpdb->postmeta,
            '_wp_attachment_context',
            $wpdb->postmeta,
            self::WP_POSTMETA_UPLOAD_LOCK_KEY,
            $limit,
        );

        /** @var array<string, string>[]|null $results */
        $results = $wpdb->get_results($sql, ARRAY_A);
        if (null === $results) {
            throw new \Exception('There was an error obtaining the list of files to be moved.');
        }

        // lock attachments
        foreach (array_column($results, 'ID') as $attachmentId) {
            update_post_meta((int) $attachmentId, self::WP_POSTMETA_UPLOAD_LOCK_KEY, time());
        }

        $wpdb->query('COMMIT');

        return $results;
    }

    private function moveAttachmentToCDN(int $attachmentId): void
    {
        /** @var \wpdb $wpdb */
        global $wpdb;

        $imageMetadata = wp_get_attachment_metadata($attachmentId);
        $file = get_attached_file($attachmentId);

        if (false === $file) {
            throw new \Exception('File not found.');
        }

        $storage = $this->storage;
        $fileRemote = $this->toRemotePath($file);
        $filesToUpload = [$file => $fileRemote];

        if (isset($imageMetadata['original_image'])) {
            $filesToUpload[path_join(dirname($file), $imageMetadata['original_image'])] = path_join(dirname($fileRemote), $imageMetadata['original_image']);
        }

        if (!empty($imageMetadata['sizes']) && is_array($imageMetadata['sizes'])) {
            foreach ($imageMetadata['sizes'] as $sizeInfo) {
                $localPath = path_join(dirname($file), $sizeInfo['file']);
                $remotePath = $this->toRemotePath($localPath);
                $filesToUpload[$localPath] = $remotePath;
            }
        }

        // if files already exist, we won't override it
        foreach ($filesToUpload as $remotePath) {
            if ($storage->exists($remotePath)) {
                throw new \Exception(sprintf('File "%s" already exists in the Storage Zone.', $remotePath));
            }
        }

        // copy files to storage
        $promises = [];
        foreach ($filesToUpload as $localPath => $remotePath) {
            $promise = new Promise\Promise(
                function () use (&$promise, $storage, $localPath, $remotePath) {
                    /** @var Promise\Promise $promise */
                    $promise->resolve($storage->upload($localPath, $remotePath));
                }
            );

            $promises[$remotePath] = $promise;
            unset($promise);
        }

        Promise\Utils::unwrap($promises);

        // start db transaction
        $wpdb->query('START TRANSACTION');

        try {
            // update metadata
            update_post_meta($attachmentId, \Bunny\Wordpress\Offloader::WP_POSTMETA_KEY, 1);
            delete_post_meta($attachmentId, self::WP_POSTMETA_ATTEMPTS_KEY);
            delete_post_meta($attachmentId, self::WP_POSTMETA_UPLOAD_LOCK_KEY);

            // commit db changes
            $wpdb->query('COMMIT');
        } catch (\Exception $e) {
            $wpdb->query('ROLLBACK');

            throw $e;
        }

        // delete original files
        foreach ($filesToUpload as $localPath => $remotePath) {
            if (file_exists($localPath)) {
                unlink($localPath);
            }
        }
    }

    private function toRemotePath(string $file): string
    {
        static $offset = null;
        if (null === $offset) {
            $offset = strlen(wp_get_upload_dir()['basedir']) + 1;
        }

        return 'wp-content/uploads/'.substr($file, $offset);
    }

    private function releaseOldLocks(): void
    {
        global $wpdb;

        $timestamp = time() - self::LOCK_TIMEOUT_SECONDS;

        $sql = $wpdb->prepare('
                DELETE FROM %i pm
                WHERE pm.post_id IN (SELECT p.ID FROM %i p WHERE p.post_type = "attachment")
                AND pm.meta_key = "%s"
                AND pm.meta_value < %d
            ',
            $wpdb->postmeta,
            $wpdb->posts,
            self::WP_POSTMETA_UPLOAD_LOCK_KEY,
            $timestamp,
        );

        $wpdb->query($sql);
    }
}
