<?php

namespace Syno\Cint\Demand\Resources\PanelistPool;

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
     * Returns all panelist pool types
     *
     * @return array
     */
    public function all(): array
    {
        return $this->client->get('/ordering/reference/panelistPool/types/');
    }
}