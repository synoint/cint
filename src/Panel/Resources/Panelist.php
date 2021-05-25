<?php
namespace Syno\Cint\Panel\Resources;

use Syno\Cint\Panel\Client;
use Syno\Cint\Traits\StatusCodes;

class Panelist
{
    use StatusCodes;

    /** @var Client */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function fetchProfile(string $apiKey, string $apiSecret, $panelistId) : array
    {
        $result = [];

        $res = $this->client->getWithRetry(
            sprintf('%s/panels/%s/panelists/%d', $this->client->getApiUrl(), $apiKey, $panelistId),
            [
                'auth'    => [$apiKey, $apiSecret],
                'headers' => ['Accept' => 'application/json'],
            ]
        );

        if ($res && $this->HTTP_OK === $res->getStatusCode()) {
            $result = json_decode($res->getBody(), true);
        }

        return $result['panelist'] ?? [];
    }

    public function fetchVariables(string $apiKey, string $apiSecret, $panelistId) : array
    {
        $result = [];

        $res = $this->client->getWithRetry(
            sprintf('%s/panels/%s/panelists/%d/variables', $this->client->getApiUrl(), $apiKey, $panelistId),
            [
                'auth'    => [$apiKey, $apiSecret],
                'headers' => ['Accept' => 'application/json'],
            ]
        );

        if ($res && $this->HTTP_OK === $res->getStatusCode()) {
            $result = json_decode($res->getBody(), true);
        }

        return $result['categories'] ?? [];
    }
}
