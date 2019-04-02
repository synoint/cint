<?php
namespace Cint\Connect\Resources;

use Syno\Cint\Connect\Client;

class Provider
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
     * Returns all data providers
     *
     * @return array
     */
    public function all(): array
    {
        return $this->client->get('/api/profiling');
    }
}
