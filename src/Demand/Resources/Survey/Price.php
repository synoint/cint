<?php

namespace Syno\Cint\Demand\Resources\Survey;

use Syno\Cint\Demand\Config;
use Syno\Cint\Demand\Client;

class Price
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
     * @param array $params - required(incidenceRate, lengthOfInterview, countryId)
     * Returns survey price estimation
     *
     * @return array
     */
    public function getEstimation($params): array
    {
        return $this->client->post('/ordering/quotes/', $params);
    }
}