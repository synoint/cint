<?php

namespace Syno\Cint\Demand\Resources;

use Syno\Cint\Demand\Client;

class Country
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
     * Returns all countries
     *
     * @return array
     */
    public function all(): array
    {
        return $this->client->get('/ordering/reference/countries/');
    }
}