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

namespace Bunny\Wordpress\Api;

use Bunny\Wordpress\Api\Dnszone\Record;
use Bunny\Wordpress\Api\Dnszone\RecordType;
use Bunny\Wordpress\Api\Exception\AuthorizationException;
use Bunny\Wordpress\Api\Exception\NotFoundException;
use Bunny\Wordpress\Api\Exception\PullzoneLocalUrlException;
use Bunny\Wordpress\Config\Optimizer;

class Client
{
    private const BASE_URL = 'https://api.bunny.net';

    private Config $config;
    private \GuzzleHttp\Client $httpClient;

    public function __construct(Config $config, ?\GuzzleHttp\Client $httpClient = null)
    {
        $this->config = $config;

        if (null === $httpClient) {
            $httpClient = new \GuzzleHttp\Client([
                'base_uri' => self::BASE_URL,
                'timeout' => 20,
                'allow_redirects' => false,
                'http_errors' => false,
                'headers' => [
                    'Accept' => 'application/json',
                    'User-Agent' => 'bunny-wp-plugin/'.BUNNYCDN_WP_VERSION,
                    'AccessKey' => $this->config->getApiKey(),
                ],
            ]);
        }

        $this->httpClient = $httpClient;
    }

    /**
     * @return Pullzone\Info[]
     */
    public function listPullzones(): array
    {
        $data = $this->request('GET', '/pullzone');

        return array_map(function ($item) {
            $hostnames = array_map(function ($hostname) {
                return $hostname['Value'];
            }, $item['Hostnames']);

            return new Pullzone\Info($item['Id'], $item['Name'], $item['OriginUrl'], $hostnames);
        }, $data);
    }

    public function getPullzoneById(int $id): Pullzone\Info
    {
        $data = $this->request('GET', sprintf('/pullzone/%s', $id));

        $hostnames = array_map(function ($hostname) {
            return $hostname['Value'];
        }, $data['Hostnames']);

        return new Pullzone\Info($data['Id'], $data['Name'], $data['OriginUrl'], $hostnames);
    }

    public function getPullzoneDetails(int $id): Pullzone\Details
    {
        $data = $this->request('GET', sprintf('/pullzone/%s', $id));
        $config = Optimizer::fromApiResponse($data);
        $edgerules = array_map(fn ($item) => Pullzone\Edgerule::fromApiResponse($item), $data['EdgeRules']);

        $hostnames = array_map(function ($hostname) {
            return $hostname['Value'];
        }, $data['Hostnames']);

        $bandwidthUsed = (int) $data['MonthlyBandwidthUsed'];
        $charges = (float) $data['MonthlyCharges'];

        return new Pullzone\Details($data['Id'], $data['Name'], $hostnames, $config, $bandwidthUsed, $charges, $edgerules);
    }

    public function getPullzoneStatistics(int $id, \DateTime $dateFrom, \DateTime $dateTo): Pullzone\Statistics
    {
        $data = $this->request('GET', '/statistics?'.http_build_query([
            'pullZone' => $id,
            'dateFrom' => $dateFrom->format('Y-m-d'),
            'dateTo' => $dateTo->format('Y-m-d'),
        ]));

        return new Pullzone\Statistics($data);
    }

    public function getBilling(): Billing\Info
    {
        $data = $this->request('GET', '/billing');
        $balance = (float) $data['Balance'];

        return new Billing\Info((int) floor($balance * 100));
    }

    /**
     * @return array<string, mixed>
     *
     * @throws \Exception
     */
    private function request(string $method, string $url, ?string $body = null): array
    {
        $options = ['headers' => []];

        if ('POST' === $method) {
            $options['headers']['Content-Type'] = 'application/json';
            $options['body'] = $body;
        }

        $response = $this->httpClient->request($method, self::BASE_URL.$url, $options);

        if (401 === $response->getStatusCode()) {
            throw new AuthorizationException();
        }

        if (404 === $response->getStatusCode()) {
            throw new NotFoundException();
        }

        if ($response->getStatusCode() < 200 || $response->getStatusCode() > 299) {
            throw new \Exception('api.bunny.net: no response ('.$response->getStatusCode().')');
        }

        $data = json_decode($response->getBody()->getContents(), true);

        if (null === $data) {
            return [];
        }

        if (!is_array($data)) {
            throw new \Exception('api.bunny.net: invalid JSON response');
        }

        return $data;
    }

    public function saveOptimizerConfig(Optimizer $config, int $pullzoneId): void
    {
        $body = json_encode($config->toApiPostRequest(), JSON_THROW_ON_ERROR);
        $this->request('POST', sprintf('/pullzone/%s', $pullzoneId), $body);
    }

    public function getUser(): User
    {
        $data = $this->request('GET', '/user');

        if (empty($data)) {
            throw new \Exception('Failure loading user from the api');
        }

        $name = '';

        if (!empty($data['FirstName']) || !empty($data['LastName'])) {
            $name = sprintf('%s %s', $data['FirstName'], $data['LastName']);
        }

        return new User(
            $name,
            $data['Email'],
        );
    }

    public function createPullzoneForCdn(string $name, string $originUrl): Pullzone\Info
    {
        $body = json_encode([
            'Name' => $name,
            'OriginUrl' => $originUrl,
            'IgnoreQueryStrings' => false,
            'QueryStringVaryParameters' => ['ver'],
            'UseStaleWhileOffline' => true,
            'UseStaleWhileUpdating' => true,
            'AccessControlOriginHeaderExtensions' => ['eot', 'ttf', 'woff', 'woff2', 'css', 'js'],
        ], JSON_THROW_ON_ERROR);

        return $this->createPullzone($body);
    }

    private function createPullzone(string $body): Pullzone\Info
    {
        $options = ['headers' => ['Content-Type' => 'application/json'], 'body' => $body];
        $response = $this->httpClient->request('POST', '/pullzone', $options);

        $data = json_decode($response->getBody()->getContents(), true);
        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new \Exception('api.bunny.net: invalid JSON response');
        }

        if ($response->getStatusCode() >= 200 && $response->getStatusCode() <= 299) {
            $hostnames = array_map(function ($hostname) {
                return $hostname['Value'];
            }, $data['Hostnames']);

            return new Pullzone\Info($data['Id'], $data['Name'], $data['OriginUrl'], $hostnames);
        }

        if (isset($data['ErrorKey'])) {
            if ('pullzone.validation' === $data['ErrorKey'] && "localhost URL is not supported\r\nParameter name: OriginUrl" === $data['Message']) {
                throw new PullzoneLocalUrlException();
            }

            throw new \Exception($data['Message'] ?: 'api.bunny.net: error while creating a pullzone.');
        }

        throw new \Exception('api.bunny.net: invalid response');
    }

    public function purgePullzoneCache(int $id): void
    {
        $this->request('POST', sprintf('/pullzone/%s/purgeCache', $id));
    }

    public function getStorageZone(int $id): Storagezone\Details
    {
        $data = $this->request('GET', sprintf('/storagezone/%d', $id));

        return new Storagezone\Details($data['Id'], $data['Name'], $data['Password']);
    }

    /**
     * @param string[] $replicationRegions
     */
    public function createStorageZone(string $name, string $region, array $replicationRegions = []): Storagezone\Details
    {
        $replicationRegions = array_map(fn ($item) => strtoupper($item), $replicationRegions);

        $body = json_encode([
            'Name' => $name,
            'Region' => $region,
            'ReplicationRegions' => $replicationRegions,
            'ZoneTier' => '1',
        ]);

        if (false === $body) {
            throw new \Exception('Failure converting payload to JSON');
        }

        $data = $this->request('POST', '/storagezone', $body);

        return new Storagezone\Details($data['Id'], $data['Name'], $data['Password']);
    }

    public function updateStorageZoneForOffloader(int $id, int $dnsZoneId, int $dnsRecordId, string $pathPrefix, string $syncToken): void
    {
        $body = json_encode([
            'OriginDnsZoneId' => $dnsZoneId,
            'OriginDnsRecordId' => $dnsRecordId,
            'WordPressCronToken' => $syncToken,
            'WordPressCronPath' => $pathPrefix,
        ]);

        if (false === $body) {
            throw new \Exception('Failure converting payload to JSON');
        }

        $this->request('POST', sprintf('/storagezone/%d', $id), $body);
    }

    public function updateStorageZoneCron(int $id, string $pathPrefix, string $syncToken): void
    {
        if (0 === $id) {
            throw new \Exception('Invalid storage zone ID');
        }

        $body = json_encode([
            'WordPressCronToken' => $syncToken,
            'WordPressCronPath' => $pathPrefix,
        ]);

        if (false === $body) {
            throw new \Exception('Failure converting payload to JSON');
        }

        $this->request('POST', sprintf('/storagezone/%d', $id), $body);
    }

    /**
     * @return Dnszone\Info[]
     */
    private function searchDnsZones(string $domain): array
    {
        $data = $this->request('GET', sprintf('/dnszone?search=%s', $domain));
        if (!isset($data['TotalItems']) || !isset($data['Items'])) {
            throw new \Exception('Error requesting DNS zones.');
        }

        $zones = [];

        foreach ($data['Items'] as $item) {
            $zones[] = Dnszone\Info::fromArray($item);
        }

        return $zones;
    }

    public function findDnsRecordForHostname(string $hostname): ?Record
    {
        $parts = explode('.', $hostname);
        if (count($parts) < 2) {
            throw new \Exception('Invalid hostname: '.$hostname);
        }

        // filter out IP addresses
        if (preg_match('/\d+$/', $parts[count($parts) - 1])) {
            throw new \Exception('Invalid hostname: '.$hostname);
        }

        $domain = sprintf('%s.%s', $parts[count($parts) - 2], $parts[count($parts) - 1]);
        $zones = $this->searchDnsZones($domain);

        foreach ($zones as $zone) {
            foreach ($zone->getRecords() as $record) {
                if (!in_array($record->getType(), [RecordType::A, RecordType::AAAA, RecordType::CNAME], true)) {
                    continue;
                }

                if ('' === $record->getName()) {
                    $full = $zone->getDomain();
                } else {
                    $full = $record->getName().'.'.$zone->getDomain();
                }

                if ($hostname === $full) {
                    return $record;
                }
            }
        }

        return null;
    }

    /**
     * @param array<string, mixed> $data
     */
    public function addEdgeRuleToPullzone(int $pullzoneId, array $data): void
    {
        $body = json_encode($data, JSON_THROW_ON_ERROR);
        $this->request('POST', sprintf('/pullzone/%d/edgerules/addOrUpdate', $pullzoneId), $body);
    }

    public function findPullzoneByName(string $name): Pullzone\Info
    {
        $rows = $this->request('GET', sprintf('/pullzone/?search=%s', $name));

        foreach ($rows as $data) {
            if ($data['Name'] !== $name) {
                continue;
            }

            $hostnames = array_map(function ($hostname) {
                return $hostname['Value'];
            }, $data['Hostnames']);

            return new Pullzone\Info($data['Id'], $data['Name'], $data['OriginUrl'], $hostnames);
        }

        throw new \Exception('Could not find pullzone.');
    }
}
