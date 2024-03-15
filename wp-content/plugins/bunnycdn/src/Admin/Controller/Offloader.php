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

namespace Bunny\Wordpress\Admin\Controller;

use Bunny\Wordpress\Admin\Container;
use Bunny\Wordpress\Api\Exception\AuthorizationException;
use Bunny\Wordpress\Config\Offloader as OffloaderConfig;
use Bunny\Wordpress\Service\AttachmentCounter;

class Offloader implements ControllerInterface
{
    private Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function run(bool $isAjax): void
    {
        $attachmentCount = $this->container->getAttachmentCounter()->count();

        if ($isAjax && isset($_GET['perform']) && 'get-statistics' === $_GET['perform']) {
            wp_send_json_success($attachmentCount);

            return;
        }

        $cdnConfig = $this->container->getCdnConfig();
        $offloaderConfig = $this->container->getOffloaderConfig();

        try {
            $this->container->getOffloaderUtils()->updateStoragePassword();

            $showCdnAccelerationAlert = $this->container->getCdnAcceleration()->shouldShowAlert();
            $isRequestAccelerated = $this->container->getCdnAcceleration()->isRequestAccelerated();
            $showApiKeyAlert = false;
        } catch (AuthorizationException $e) {
            $showCdnAccelerationAlert = false;
            $isRequestAccelerated = false;
            $showApiKeyAlert = true;
        }

        if ($cdnConfig->isAgencyMode()) {
            $this->container->renderTemplateFile('error.api-unavailable.php', [
                'error' => 'There is no API key configured.',
            ]);

            return;
        }

        if ($cdnConfig->isAccelerated() && !$offloaderConfig->isEnabled() && !$isRequestAccelerated) {
            $this->container->renderTemplateFile('offloader.warning.php', [
                'attachments' => $attachmentCount,
                'config' => $offloaderConfig,
            ], ['cssClass' => 'offloader']);

            return;
        }

        if (!$cdnConfig->isAccelerated()) {
            $this->container->renderTemplateFile('offloader.instructions.php', [
                'attachments' => $attachmentCount,
                'config' => $offloaderConfig,
                'showApiKeyAlert' => $showApiKeyAlert,
                'showCdnAccelerationAlert' => $showCdnAccelerationAlert,
                'suggestAcceleration' => $isRequestAccelerated,
            ], ['cssClass' => 'offloader']);

            return;
        }

        $errorMessage = null;
        $successMessage = null;

        if (!empty($_POST)) {
            check_admin_referer('bunnycdn-save-offloader');

            if (!$offloaderConfig->isConfigured()) {
                try {
                    $this->container->newOffloaderSetup()->perform($_POST['offloader'] ?? []);
                    $successMessage = 'The Content Offloader is now configured.';
                } catch (\Exception $e) {
                    $errorMessage = 'Error enabling the Content Offloader: '.$e->getMessage();
                }

                $offloaderConfig = $this->container->reloadOffloaderConfig();
            } else {
                $wasEnabled = $offloaderConfig->isEnabled();
                $offloaderConfig->handlePost($_POST['offloader'] ?? []);
                $offloaderConfig->saveToWpOptions();

                if (!$wasEnabled && $offloaderConfig->isEnabled() && $offloaderConfig->isSyncExisting() && $attachmentCount[AttachmentCounter::LOCAL] > 0) {
                    try {
                        $pathPrefix = $this->container->getOffloaderUtils()->getPathPrefix();
                        [$syncToken, $syncTokenHash] = $this->container->getOffloaderUtils()->generateSyncToken();

                        $this->container->getApiClient()->updateStorageZoneCron($offloaderConfig->getStorageZoneId(), $pathPrefix, $syncToken);
                        $offloaderConfig->saveSyncOptions($pathPrefix, $syncTokenHash);

                        $successMessage = 'The settings have been saved.';
                    } catch (\Exception $e) {
                        $errorMessage = 'api.bunny.net: could not update cronjob. Error: '.$e->getMessage();
                    }
                } else {
                    $successMessage = 'The settings have been saved.';
                }
            }
        }

        $cdnUrl = add_query_arg([
            'page' => 'bunnycdn',
            'section' => 'cdn',
        ], admin_url('admin.php'));

        if (!$offloaderConfig->isConfigured()) {
            try {
                $record = $this->container->getCdnAcceleration()->getDNSRecord();
                $pullzoneId = $record->getAcceleratedPullzoneId();

                if (null === $pullzoneId) {
                    throw new \Exception('We could not find an accelerated pullzone for this domain.');
                }

                $pullzone = $this->container->getApiClient()->getPullzoneDetails($pullzoneId);
                $pathPrefix = $this->container->getOffloaderUtils()->getPathPrefix();
                $storageZoneId = $this->container->getOffloaderUtils()->checkForExistingEdgeRule($pullzone, $pathPrefix);

                if (null !== $storageZoneId) {
                    $storageZone = $this->container->getApiClient()->getStorageZone($storageZoneId);
                    $offloaderConfig->setStorageZone($storageZone);
                }
            } catch (\Exception $e) {
                $errorMessage = 'Enabling the Content Offloading will not be possible: '.$e->getMessage();
            }
        }

        $this->container->renderTemplateFile('offloader.config.php', [
            'attachments' => $attachmentCount,
            'cdnUrl' => $cdnUrl,
            'config' => $offloaderConfig,
            'errorMessage' => $errorMessage,
            'replicationRegions' => OffloaderConfig::STORAGE_REGIONS_SSD,
            'showApiKeyAlert' => $showApiKeyAlert,
            'showCdnAccelerationAlert' => $showCdnAccelerationAlert,
            'successMessage' => $successMessage,
        ], ['cssClass' => 'offloader']);
    }
}
