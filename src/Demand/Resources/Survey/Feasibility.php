<?php

namespace Syno\Cint\Demand\Resources\Survey;

use Syno\Cint\Demand\Client;

class Feasibility
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