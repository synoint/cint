<?php

namespace Syno\Cint\Demand\Resources\Survey;

use Syno\Cint\Demand\Client;

class Survey
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
     * Update survey project
     *
     * @return array
     */
    public function update(int $id, array $params): array
    {
        return $this->client->put('/ordering/surveys/'.$id, $params);
    }

    /**
     * @param int $id
     * @param int $statusId
     * Changes survey project status
     *
     * @return array
     */
    public function changeStatus(int $id, int $statusId): array
    {
        return $this->client->patch('/ordering/surveys/' . $id, [['op' => 'replace', 'path' => '/status', 'value' => $statusId]]);
    }

    /**
     * @param int $id
     * @param float $cpi
     * Changes survey cost per interview(cpi)
     *
     * @return array
     */
    public function changeCpi(int $id, float $cpi): array
    {
        return $this->client->patch('/ordering/surveys/' . $id, [['op' => 'replace', 'path' => '/cpi/amount', 'value' => $cpi]]);
    }

    /**
     * @param int $id
     * @param int $surveyLimit
     * @param array $quotasLimit
     * Updates survey limits
     *
     * @return array
     */
    public function updateLimits(int $id, int $surveyLimit, array $quotasLimit): array
    {
        $params = [['op' => 'replace', 'path' => '/limit', 'value' => $surveyLimit]];

        foreach($quotasLimit as $quotaGroupKey => $quotaGroup){
            foreach($quotaGroup as $quotaKey => $quotaLimit){
                $params[] = ['op' => 'replace', 'path' => '/quotaGroups/'.$quotaGroupKey.'/quotas/'.$quotaKey.'/limit', 'value' => $quotaLimit];
            }
        }

        return $this->client->patch('/ordering/surveys/' . $id, $params);
    }

    /**
     * @param integer $id
     * Returns survey project by id
     *
     * @return array
     */
    public function getOne(int $id): array
    {
        return $this->client->get('/ordering/surveys/' . $id);
    }

    /**
     * @param integer $id
     * Returns survey statistics by id
     *
     * @return array
     */
    public function getStatistics(int $id): array
    {
        return $this->client->get('/ordering/surveys/' . $id.'/statistics');
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

    /**
     * @param integer $surveyId
     * Returns survey current cost
     *
     * @return array
     */
    public function getCurrentCost(int $surveyId): array
    {
        return $this->client->get("/ordering/surveys/".$surveyId."/CurrentCost");
    }

    /**
     * @param integer $surveyId
     * Returns survey test urls
     *
     * @return array
     */
    public function getTestLinks(int $surveyId): array
    {
        return $this->client->get("/ordering/surveys/".$surveyId."/Test");
    }
}