<?php

namespace Syno\Cint\Demand\Resources\Panel;

use Syno\Cint\Demand\Client;

class Panel
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
     * Returns all panels by country
     * @param int $countryId
     *
     * @return array
     */
    public function all(int $countryId): array
    {
        return $this->client->get('/ordering/country/'.$countryId.'/panels/');
    }
}