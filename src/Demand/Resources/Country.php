<?php

namespace Syno\Cint\Demand\Resources;

use Syno\Cint\Demand\Config;
use Syno\Cint\Demand\Client;

class Country
{
    /** @var Config */
    private $config;

    /** @var Client */
    private $client;

    /**
     * @param Config $config
     * @param Client $client
     */
    public function __construct(Config $config, Client $client)
    {
        $this->config = $config;
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