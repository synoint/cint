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
     * @param int $incidenceRate
     * @param int $lengthOfInterview
     * @param int $countryId
     * Returns survey price estimation
     *
     * @return array
     */
    public function getEstimation(int $incidenceRate, int $lengthOfInterview, int $countryId): array
    {
        return $this->client->post('/ordering/quotes/', ['incidenceRate' => $incidenceRate, 'lengthOfInterview' => $lengthOfInterview, 'countryId' => $countryId]);
    }
}