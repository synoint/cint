<?php
namespace Cint\Connect\Resources;

use Syno\Cint\Connect\Client;

class Dimension
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
     * Returns all dimensions by provider
     *
     * @param string $provider
     *
     * @return array
     */
    public function all(string $provider): array
    {
        return $this->client->get(sprintf('/api/profiling/%s', $provider));
    }

    /**
     * Returns all dimensions for "Basic Profiling" data provider
     *
     * @return array
     */
    public function basicProfiling(): array
    {
        return $this->client->get('/api/profiling/BasicProfiling');
    }

    /**
     * Returns all dimensions for "Global Questions" data provider
     *
     * @return array
     */
    public function globalQuestions(): array
    {
        return $this->client->get('/api/profiling/GlobalQuestions');
    }

    /**
     * Returns all dimensions for "User Agent" data provider
     *
     * @return array
     */
    public function userAgent(): array
    {
        return $this->client->get('/api/profiling/UserAgent');
    }

    /**
     * Returns all dimensions for "Custom Metrics" data provider
     *
     * @return array
     */
    public function customMetrics(): array
    {
        return $this->client->get('/api/profiling/CustomMetrics');
    }

    /**
     * Returns all dimensions for "Match Data" data provider
     *
     * @return array
     */
    public function matchData(): array
    {
        return $this->client->get('/api/profiling/MatchData');
    }
}
