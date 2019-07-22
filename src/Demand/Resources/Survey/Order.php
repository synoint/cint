<?php

namespace Syno\Cint\Demand\Resources\Survey;

use Syno\Cint\Demand\Config;
use Syno\Cint\Demand\Client;

class Order
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
     * @param array $params
     * Creates survey project
     *
     * @return array
     */
    public function createNew($params): array
    {
        return $this->client->post('/ordering/surveys/', $params);
    }

    /**
     * @param array $params
     * Changes survey project status
     *
     * @return array
     */
    public function changeStatus($id, $params): array
    {
        return $this->client->put('/ordering/surveys/' . $id, $params);
    }

    /**
     * @param integer $id
     * Returns survey project by id
     *
     * @return array
     */
    public function getOne($id): array
    {
        return $this->client->get('/ordering/surveys/' . $id);
    }

    /**
     * Returns all survey projects
     *
     * @return array
     */
    public function getAll(): array
    {
        return $this->client->get('/ordering/surveys/');
    }
}