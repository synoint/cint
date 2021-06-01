<?php
namespace Syno\Cint\Panel\Resources;

use GuzzleHttp\Exception\ClientException;
use Symfony\Component\HttpFoundation\Response;
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

    public function insertTransaction(string $apiKey, string $apiSecret, int $panelistId, int $points): array
    {
        $identifier = 'customTransaction-' . (new \DateTime('now'))->format('Y-m-d H:i:s');
        try {
            $response = $this->client->post(
                sprintf('%s/panels/%s/panelists/%d/transactions', $this->client->getApiUrl(), $apiKey, $panelistId),
                [
                    'auth'    => [$apiKey, $apiSecret],
                    'headers' => ['Accept' => 'application/json'],
                    'json'    => [
                        'transaction' => [
                            'type'       => 'tt_rew',
                            'points'     => $points,
                            'identifier' => $identifier
                        ],
                    ]
                ]
            );
            if (Response::HTTP_CREATED === $response->getStatusCode()) {
                $result = json_decode($response->getBody());

                return $result->transaction;
            }
        } catch (ClientException $e) {
            $summary = [];
            $errors  = json_decode($e->getResponse()->getBody()->getContents(), true);

            foreach ($errors as $field => $messages) {
                $summary[] = sprintf('%s %s', $field, implode('; ', $messages));
            }

            throw new \RuntimeException(implode('; ', $summary), $e->getCode());
        }

        return [];
    }
}

