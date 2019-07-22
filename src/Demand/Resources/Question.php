<?php

namespace Syno\Cint\Demand\Resources;

use Syno\Cint\Demand\Config;
use Syno\Cint\Demand\Client;

class Question
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
     * Returns all questions
     *
     * @return array
     */
    public function all(): array
    {
        return $this->client->get('/ordering/reference/questions/');
    }

    /**
     * @param integer $countryId
     * Returns all questions from one country
     *
     * @return array
     */
    public function allFromOneCountry(int $countryId): array
    {
        return $this->client->get('/ordering/reference/questions', ['countryId' => $countryId]);
    }
}