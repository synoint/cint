<?php

namespace Syno\Cint\Demand\Resources\Device;

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
     * Returns all device types
     *
     * @return array
     */
    public function all(): array
    {
        return $this->client->get('/ordering/reference/device/types/');
    }
}