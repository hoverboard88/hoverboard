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

namespace {
    function bunnycdn_activate_plugin(): void
    {
        if (!get_option('bunnycdn_wizard_finished')) {
            require_once __DIR__.'/../vendor/autoload.php';
            bunnycdn_container()->newMigrateFromV1()->perform();
        }
    }
    function bunnycdn_uninstall_plugin(): void
    {
        require_once __DIR__.'/../vendor/autoload.php';
        \Bunny\Wordpress\Config\Reset::all();
    }
    function bunnycdn_container(): \Bunny\Wordpress\Container
    {
        static $container;
        if (null !== $container) {
            return $container;
        }
        $container = new \Bunny\Wordpress\Container();

        return $container;
    }
    function bunnycdn_http_proxy(): ?string
    {
        static $proxy = '';
        if ('' !== $proxy) {
            return $proxy;
        }
        $wpProxy = new \WP_HTTP_Proxy();
        if (!$wpProxy->is_enabled()) {
            $proxy = null;

            return $proxy;
        }
        if ($wpProxy->use_authentication()) {
            $proxy = sprintf('http://%s@%s:%d', $wpProxy->authentication(), $wpProxy->host(), $wpProxy->port());
        } else {
            $proxy = sprintf('http://%s:%d', $wpProxy->host(), $wpProxy->port());
        }

        return $proxy;
    }
    function bunnycdn_offloader_remote_path(string $file): string
    {
        static $offset = null;
        static $overridePrefix = '';
        if (null === $offset) {
            if (defined('WP_CONTENT_DIR')) {
                $offset = strlen(WP_CONTENT_DIR);
                $overridePrefix = 'wp-content/';
            } else {
                $offset = strlen(ABSPATH);
            }
        }

        return $overridePrefix.ltrim(substr($file, $offset), '/');
    }
    /**
     * @param string[] $paths
     *
     * @return string[]
     */
    function bunnycdn_offloader_filter_delete_paths(array $paths): array
    {
        $result = [];
        foreach ($paths as $path) {
            if (empty($path)) {
                continue;
            }
            if (str_ends_with($path, '/') || str_ends_with($path, '/wp-content') || str_ends_with($path, '/wp-content/uploads')) {
                trigger_error('bunnycdn: offloader: aborted attempt to delete '.$path, \E_USER_NOTICE);
                continue;
            }
            $result[] = $path;
        }

        return $result;
    }
    /**
     * @param string[] $excludes
     */
    function bunnycdn_is_path_excluded(string $path, array $excludes, bool $leadingSlash = false): bool
    {
        foreach ($excludes as $excludedPath) {
            if ($leadingSlash && !str_starts_with($excludedPath, '*') && !str_starts_with($excludedPath, '/')) {
                $excludedPath = '/'.$excludedPath;
            }
            if (!str_contains($excludedPath, '*')) {
                return $excludedPath === $path;
            }
            $prefix = '^';
            $suffix = '$';
            if (str_starts_with($excludedPath, '*')) {
                $prefix = '';
            }
            if (str_ends_with($excludedPath, '*')) {
                $suffix = '';
            }
            $regex = '#'.$prefix.str_replace('\\*', '(.*)', preg_quote($excludedPath)).$suffix.'#';
            if (preg_match($regex, $path)) {
                return true;
            }
        }

        return false;
    }
}
