<?php

namespace Syno\Cint\Demand\Resources;

use Syno\Cint\Demand\Client;

class Gender
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
     * Returns all genders
     *
     * @return array
     */
    public function all(): array
    {
        return $this->client->get('/ordering/reference/genders/');
    }
}