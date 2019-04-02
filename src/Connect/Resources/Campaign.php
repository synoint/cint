<?php
namespace Cint\Connect\Resources;

use Syno\Cint\Connect\Config;
use Syno\Cint\Connect\Client;

class Campaign
{
    /** @var Config */
    private $config;

    /** @var Client */
    private $client;

    /**
     * @param Config $config
     * @param Client $client
     */
    public function __construct(Config $config, Client $client)
    {
        $this->config = $config;
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
            sprintf('/api/%s/campaign', $this->config->getAccountId())
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
            sprintf('/api/%s/campaign/%d', $this->config->getAccountId(), $campaignId)
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
            sprintf('/api/%s/campaign/%d/summary', $this->config->getAccountId(), $campaignId)
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
            sprintf('/api/%s/campaign/%d/histogram', $this->config->getAccountId(), $campaignId)
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
            sprintf('/api/%s/campaign/%d/metrics', $this->config->getAccountId(), $campaignId)
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
            sprintf('/api/%s/campaign/%d/metrics/referer', $this->config->getAccountId(), $campaignId)
        );
    }
}

