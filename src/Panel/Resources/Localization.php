<?php
namespace Syno\Cint\Panel\Resources;

use Syno\Cint\Panel\Client;
use Syno\Cint\Traits\StatusCodes;

class Localization
{
    use StatusCodes;

    /** @var Client */
    private $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function fetchCountries() : array
    {
        $result = [];

        $res = $this->client->getWithRetry(
            sprintf('%s/countries', $this->client->getApiUrl()),
            [
                'headers' => ['Accept' => 'application/json'],
            ]
        );

        if ($this->HTTP_OK === $res->getStatusCode()) {
            $result = json_decode($res->getBody(), true);
        }

        return $result['countries'] ?? [];
    }

    /**
     * @return array|mixed
     */
    public function fetchRegionTypes(string $url)
    {
        $result = [];

        $res = $this->client->getWithRetry(
            $url,
            [
                'headers' => ['Accept' => 'application/json'],
            ]
        );

        if ($this->HTTP_OK === $res->getStatusCode()) {
            $result = json_decode($res->getBody(), true);
        }

        return $result['region_types'] ?? [];
    }

    /**
     * @return array|mixed
     */
    public function fetchRegions(string $url)
    {
        $result = [];

        $res = $this->client->getWithRetry(
            $url,
            [
                'headers' => ['Accept' => 'application/json'],
            ]
        );

        if ($this->HTTP_OK === $res->getStatusCode()) {
            $result = json_decode($res->getBody(), true);
        }

        return $result['regions'] ?? [];
    }
}
