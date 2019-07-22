<?php

namespace Syno\Cint\Demand\Resources\Device;

use Syno\Cint\Demand\Config;
use Syno\Cint\Demand\Client;

class Capability
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
     * Returns all device capabilities
     *
     * @return array
     */
    public function all(): array
    {
        return $this->client->get('/ordering/reference/device/capabilities/');
    }
}