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

use Bunny\Wordpress\Offloader;

class AttachmentCounter
{
    public const BUNNY = 'Bunny Storage';
    public const LOCAL = 'Local';

    /**
     * @return array{"Bunny Storage": int, "Local": int}
     */
    public function count(): array
    {
        /** @var \wpdb */
        global $wpdb;

        $attachmentCount = [self::LOCAL => 0, self::BUNNY => 0];

        /** @var string $sql */
        $sql = $wpdb->prepare(
            'SELECT COUNT(p.ID) AS count, pm.meta_key
                    FROM %i p
                    LEFT JOIN %i pm ON pm.post_id = p.ID AND pm.meta_key = "%s"
                    LEFT JOIN %i pm2 ON p.ID = pm2.post_id AND pm2.meta_key = "%s"
                    WHERE p.post_type = "attachment" AND pm2.meta_value IS NULL
                    GROUP BY pm.meta_key
            ',
            $wpdb->posts,
            $wpdb->postmeta,
            Offloader::WP_POSTMETA_KEY,
            $wpdb->postmeta,
            '_wp_attachment_context'
        );

        /** @var array<string, string>[]|null $results */
        $results = $wpdb->get_results($sql, ARRAY_A);

        if (null === $results) {
            error_log('bunny.net: could not count attachments');

            return $attachmentCount;
        }

        foreach ($results as $row) {
            if (Offloader::WP_POSTMETA_KEY === $row['meta_key']) {
                $attachmentCount[self::BUNNY] = (int) $row['count'];
                continue;
            }

            $attachmentCount[self::LOCAL] = (int) $row['count'];
        }

        return $attachmentCount;
    }
}
