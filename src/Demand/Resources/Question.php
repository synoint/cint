<?php

namespace Syno\Cint\Demand\Resources;

use Syno\Cint\Demand\Client;

class Question
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