<?php
namespace Syno\Cint\Panel\Resources;

use GuzzleHttp\Exception\ClientException;
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

    public function fetchProfile(string $apiKey, string $apiSecret, $panelistId): array
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

    public function fetchVariables(string $apiKey, string $apiSecret, int $panelistId): array
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

    public function update(string $apiKey, string $apiSecret, int $panelistId, array $data): array
    {
        $result = [];

        $res = $this->client->patch(
            sprintf('%s/panels/%s/panelists/%d', $this->client->getApiUrl(), $apiKey, $panelistId),
            [
                'auth'    => [$apiKey, $apiSecret],
                'headers' => ['Accept' => 'application/json'],
                'json'    => ['panelist' => $data]
            ]
        );

        if ($res && $this->HTTP_OK === $res->getStatusCode()) {
            $result = json_decode($res->getBody(), true);
        }

        return $result['panelist'] ?? [];
    }

    public function unsubscribe(string $apiKey, string $apiSecret, int $panelistId)
    {
        $res = $this->client->delete(
            sprintf('%s/panels/%s/panelists/%d', $this->client->getApiUrl(), $apiKey, $panelistId),
            [
                'auth'    => [$apiKey, $apiSecret],
                'headers' => ['Accept' => 'application/json'],
            ]
        );

        if ($res && $this->HTTP_OK === $res->getStatusCode()) {
            return json_decode($res->getBody(), true);
        }

        return null;
    }

    public function fetchProfileByEmail(string $apiKey, string $apiSecret, string $email): array
    {
        $result = [];

        $res = $this->client->getWithRetry(
            sprintf('%s/panels/%s/panelists?email=%s', $this->client->getApiUrl(), $apiKey, $email),
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

    public function register(string $apiKey, string $apiSecret, array $data) : array
    {
        $result = [];

        $res = $this->client->post(
            sprintf('%s/panels/%s/panelists', $this->client->getApiUrl(), $apiKey),
            [
                'auth'    => [$apiKey, $apiSecret],
                'headers' => ['Accept' => 'application/json'],
                'json'    => ['panelist' => $data]
            ]
        );

        if ($res && $this->HTTP_CREATED === $res->getStatusCode()) {
            $result = json_decode($res->getBody(), true);
        }

        return $result['panelist'] ?? [];
    }
}
