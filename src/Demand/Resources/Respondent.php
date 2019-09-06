<?php

namespace Syno\Cint\Demand\Resources;

use Syno\Cint\Demand\Config;
use Syno\Cint\Demand\Client;
use GuzzleHttp\Exception\ClientException;

class Respondent
{
    const NOT_FOUND = 404;

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
}
