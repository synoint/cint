<?php

namespace Syno\Cint\Demand\Resources\Survey;

use Syno\Cint\Demand\Client;

class Price
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