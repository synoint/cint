<?php

namespace Syno\Cint\Demand\Resources;

use Syno\Cint\Demand\Client;

class Webhook
{
    /** @var Client */
    private $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $url
     * @param string $secret
     * Subscribes for webhook
     *
     * @return array
     */
    public function add(string $url, string $secret): array
    {
        return $this->client->post('/webhooks', ['postbackUrl' => $url, 'secret' => $secret]);
    }

    /**
     * Returns all subscribed webhooks
     *
     * @return array
     */
    public function all(): array
    {
        return $this->client->get('/webhooks');
    }

    /**
     * @param integer $webhookId
     * Returns subscribed webhook
     *
     * @return array
     */
    public function get(int $webhookId): array
    {
        return $this->client->get('/webhooks/' . $webhookId);
    }

    /**
     * @param integer $webhookId
     * Removes subscribed webhook
     *
     * @return array
     */
    public function delete(int $webhookId): array
    {
        return $this->client->delete('/webhooks/' . $webhookId);
    }
}