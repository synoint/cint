<?php
namespace Syno\Cint\Panel\Resources;

use Syno\Cint\Panel\Client;
use Syno\Cint\Traits\StatusCodes;

class Transaction
{
    use StatusCodes;

    /** @var Client */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function fetchTransactions(string $apiKey, string $apiSecret, int $panelistId): array
    {
        $result = [];

        $res = $this->client->getWithRetry(
            sprintf('%s/panels/%s/panelists/%d/transactions', $this->client->getApiUrl(), $apiKey, $panelistId),
            [
                'auth'    => [$apiKey, $apiSecret],
                'headers' => ['Accept' => 'application/json'],
            ]
        );

        if ($res && $this->HTTP_OK === $res->getStatusCode()) {
            $result = json_decode($res->getBody(), true);
        }

        return $result;
    }
}

