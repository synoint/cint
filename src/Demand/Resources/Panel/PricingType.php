<?php

namespace Syno\Cint\Demand\Resources\Panel;

use Syno\Cint\Demand\Client;

class PricingType
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
     * Returns all panels pricing types
     *
     * @return array
     */
    public function all(): array
    {
        return $this->client->get('/ordering/reference/panel/pricingTypes/');
    }
}