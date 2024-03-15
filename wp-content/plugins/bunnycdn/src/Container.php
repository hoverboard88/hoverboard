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

namespace Bunny\Wordpress;

use Bunny\Storage\Client as StorageClient;
use Bunny\Wordpress\Api\Client;
use Bunny\Wordpress\Api\Config as ApiConfig;
use Bunny\Wordpress\Config\Cdn as CdnConfig;
use Bunny\Wordpress\Config\Fonts as FontsConfig;
use Bunny\Wordpress\Config\Offloader as OffloaderConfig;
use Bunny\Wordpress\Service\AttachmentCounter;
use Bunny\Wordpress\Service\AttachmentMover;
use Bunny\Wordpress\Service\MigrateFromV1;
use Bunny\Wordpress\Utils\Offloader as OffloaderUtils;

class Container
{
    private ?CdnConfig $cdnConfig = null;
    private ?OffloaderConfig $offloaderConfig = null;

    public function getApiClient(): Client
    {
        static $instance;

        if (null !== $instance) {
            return $instance;
        }

        $instance = new Client($this->getApiConfig());

        return $instance;
    }

    public function getApiConfig(): ApiConfig
    {
        static $instance;

        if (null !== $instance) {
            return $instance;
        }

        $instance = ApiConfig::fromWpOptions();

        return $instance;
    }

    public function getCdnConfig(): CdnConfig
    {
        if (null !== $this->cdnConfig) {
            return $this->cdnConfig;
        }

        $this->cdnConfig = CdnConfig::fromWpOptions();

        return $this->cdnConfig;
    }

    private function reloadCdnConfig(): CdnConfig
    {
        $this->cdnConfig = null;

        return $this->getCdnConfig();
    }

    public function getFontsConfig(): FontsConfig
    {
        static $instance;

        if (null !== $instance) {
            return $instance;
        }

        $instance = FontsConfig::fromWpOptions();

        return $instance;
    }

    public function getOffloaderConfig(): OffloaderConfig
    {
        if (null !== $this->offloaderConfig) {
            return $this->offloaderConfig;
        }

        $this->offloaderConfig = OffloaderConfig::fromWpOptions();

        return $this->offloaderConfig;
    }

    public function reloadOffloaderConfig(): OffloaderConfig
    {
        $this->offloaderConfig = null;

        return $this->getOffloaderConfig();
    }

    public function newMigrateFromV1(): MigrateFromV1
    {
        return new MigrateFromV1(function () {
            $this->reloadCdnConfig()->saveToWpOptions();
        });
    }

    public function getAttachmentCounter(): AttachmentCounter
    {
        static $instance;

        if (null !== $instance) {
            return $instance;
        }

        $instance = new AttachmentCounter();

        return $instance;
    }

    public function newAttachmentMover(): AttachmentMover
    {
        return new AttachmentMover($this->getStorageClient(), $this->getOffloaderConfig());
    }

    private function getStorageClient(): StorageClient
    {
        static $instance;

        if (null !== $instance) {
            return $instance;
        }

        $instance = new StorageClient(
            $this->getOffloaderConfig()->getStoragePassword(),
            $this->getOffloaderConfig()->getStorageZone(),
            OffloaderConfig::STORAGE_REGION_SSD_MAIN,
        );

        return $instance;
    }

    public function getOffloaderUtils(): OffloaderUtils
    {
        static $instance;

        if (null !== $instance) {
            return $instance;
        }

        $instance = new OffloaderUtils(
            $this->getApiClient(),
            $this->getAttachmentCounter(),
            $this->getOffloaderConfig(),
        );

        return $instance;
    }
}
