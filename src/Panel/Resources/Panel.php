<?php
namespace Syno\Cint\Panel\Resources;

use Syno\Cint\Panel\Client;
use Syno\Cint\Traits\StatusCodes;

class Panel
{
    use StatusCodes;

    /** @var Client */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function fetchDetails(string $apiKey, string $apiSecret) : array
    {
        $result = [];

        $res = $this->client->getWithRetry(
            sprintf('%s/panels/%s', $this->client->getApiUrl(), $apiKey),
            [
                'auth'    => [$apiKey, $apiSecret],
                'headers' => ['Accept' => 'application/json'],
            ]
        );

        if ($this->HTTP_OK === $res->getStatusCode()) {
            $result = json_decode($res->getBody(), true);
        }

        return $result ?? [];
    }

    public function fetchPaymentMethods(string $apiKey, string $apiSecret) : array
    {
        $result = [];

        $res = $this->client->getWithRetry(
            sprintf('%s/panels/%s/payment_methods', $this->client->getApiUrl(), $apiKey),
            [
                'auth'    => [$apiKey, $apiSecret],
                'headers' => ['Accept' => 'application/json'],
            ]
        );

        if ($this->HTTP_OK === $res->getStatusCode()) {
            $result = json_decode($res->getBody(), true);
        }

        return $result ?? [];
    }

    public function fetchQuestions(string $apiKey, string $apiSecret): \SimpleXMLElement
    {
        $result = [];

        $res = $this->client->getWithRetry(
            sprintf('%s/panels/%s/questions', $this->client->getApiUrl(), $apiKey),
            [
                'auth'    => [$apiKey, $apiSecret],
                'headers' => ['Accept' => 'application/xml']
            ]
        );

        if ($this->HTTP_OK === $res->getStatusCode()) {
            $result = simplexml_load_string($res->getBody());
        }

        return $result;
    }

    public function fetchEvents(string $apiKey, string $apiSecret, int $lastEventId = 0): array
    {
        $result = [];

        $res = $this->client->getWithRetry(
            sprintf('%s/panels/%s/events?since=%d', $this->client->getApiUrl(), $apiKey, $lastEventId),
            [
                'auth'    => [$apiKey, $apiSecret],
                'headers' => ['Accept' => 'application/json']
            ]
        );

        if ($this->HTTP_OK === $res->getStatusCode()) {
            $result = json_decode($res->getBody(), true);
        }

        return $result;
    }
}
