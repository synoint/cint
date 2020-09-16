<?php
namespace Syno\Cint\Connect\Resources;

use Syno\Cint\Connect\Client;

class Campaign
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
     * Returns all campaigns
     *
     * @return array
     */
    public function all(): array
    {
        return $this->client->get(
            sprintf('/api/%d/campaign', $this->client->getAccountId())
        );
    }

    /**
     * @param int $campaignId
     *
     * @return array
     */
    public function details(int $campaignId): array
    {
        return $this->client->get(
            sprintf('/api/%d/campaign/%d', $this->client->getAccountId(), $campaignId)
        );
    }

    /**
     * @param int $campaignId
     *
     * @return array
     */
    public function summary(int $campaignId) : array
    {
        return $this->client->get(
            sprintf('/api/%d/campaign/%d/summary', $this->client->getAccountId(), $campaignId)
        );
    }

    /**
     * @param int $campaignId
     *
     * @return array
     */
    public function histogram(int $campaignId) : array
    {
        return $this->client->get(
            sprintf('/api/%d/campaign/%d/histogram', $this->client->getAccountId(), $campaignId)
        );
    }

    /**
     * @param int $campaignId
     *
     * @return array
     */
    public function metrics(int $campaignId) : array
    {
        return $this->client->get(
            sprintf('/api/%d/campaign/%d/metrics', $this->client->getAccountId(), $campaignId)
        );
    }

    /**
     * @param int $campaignId
     *
     * @return array
     */
    public function referers(int $campaignId) : array
    {
        return $this->client->get(
            sprintf('/api/%d/campaign/%d/metrics/referer', $this->client->getAccountId(), $campaignId)
        );
    }
}

