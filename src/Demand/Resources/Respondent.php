<?php

namespace Syno\Cint\Demand\Resources;

use Syno\Cint\Demand\Client;
use GuzzleHttp\Exception\ClientException;

class Respondent
{
    const NOT_FOUND = 404;

    /** @var Client */
    private $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }


    public function profile(string $guid): array
    {
        $result = [];
        try {
            $result = $this->client->get(sprintf('/fulfillment/respondents/%s', $guid));
        } catch (ClientException $e) {
            // 404 is not critical in this case
            if (self::NOT_FOUND !== $e->getCode()) {
                throw $e;
            }
        }

        return $result;
    }

    /**
     * @param string $guid
     * @param int $statusId
     * Changes respondent status to Complete
     *
     * @return array
     */
    public function changeStatus(string $guid, int $statusId): array
    {
        return $this->client->post('/fulfillment/respondents/transition', ['id' => $guid, 'status' => $statusId]);
    }

    /**
     * @param string $guid
     * @param int $statusId
     * Changes respondent status to Screen out and etc...
     *
     * @return array
     */
    public function reconcileStatus(string $guid, int $statusId): array
    {
        return $this->client->post('/fulfillment/respondents/reconciliations', [['id' => $guid, 'status' => $statusId]]);
    }
}
