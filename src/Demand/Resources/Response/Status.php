<?php

namespace Syno\Cint\Demand\Resources\Response;

use Syno\Cint\Demand\Client;

class Status
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
     * Returns all response statuses
     *
     * @return array
     */
    public function all(): array
    {
        return $this->client->get('/ordering/reference/response/statuses/');
    }
}