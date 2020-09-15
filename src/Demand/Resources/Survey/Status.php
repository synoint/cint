<?php

namespace Syno\Cint\Demand\Resources\Survey;

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
     * Returns all survey statuses
     *
     * @return array
     */
    public function all(): array
    {
        return $this->client->get('/ordering/reference/survey/statuses/');
    }
}