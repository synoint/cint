<?php

namespace Syno\Cint\Demand\Resources\Survey;

use Syno\Cint\Demand\Config;
use Syno\Cint\Demand\Client;

class Feasibility
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
     * @param array $params
     * Returns survey wanted answers feasibility estimate
     *
     * @return array
     */
    public function getEstimation($params): array
    {
        return $this->client->post('/ordering/feasibilityestimates/', $params);
    }
}