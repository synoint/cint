<?php

namespace Syno\Cint\Demand\Resources\Limit;

use Syno\Cint\Demand\Client;

class Type
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
     * Returns all limit types
     *
     * @return array
     */
    public function all(): array
    {
        return $this->client->get('/ordering/reference/limit/types/');
    }
}