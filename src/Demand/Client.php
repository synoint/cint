<?php

namespace Syno\Cint\Demand;

use Syno\Cint\HttpClient;

class Client
{
    const HTTP_OK = 200;
    const HTTP_CREATED = 201;
    const HTTP_ACCEPTED = 202;
    const HTTP_NO_CONTENT = 204;

    /** @var Config */
    private $config;

    /** @var HttpClient */
    private $client;

    /**
     * @param Config $config
     * @param HttpClient $client
     */
    public function __construct(Config $config, HttpClient $client)
    {
        $this->config = $config;
        $this->client = $client;
    }

    /**
     * @param string $uri
     * @param array $parameters
     *
     * @return array
     */
    public function get(string $uri, array $parameters = null): array
    {
        $result = [];

        $headerParameters = [
            'headers' =>
                [
                    'x-api-key' => $this->config->getApiKey()
                ]
        ];

        if (!empty($parameters)) {
            $parameters = array_merge($headerParameters, ['query' => $parameters]);
        } else {
            $parameters = $headerParameters;
        }

        $response = $this->client->request(
            'GET',
            $this->config->getDomain() . $uri, $parameters
        );

        if (self::HTTP_OK === $response->getStatusCode()) {
            $result = json_decode($response->getBody(), true);
        }

        return $result;
    }

    public function post(string $uri, array $parameters = null): array
    {
        $result = [];

        $headerParameters = [
            'headers' =>
                [
                    'x-api-key' => $this->config->getApiKey()
                ]
        ];

        if (!empty($parameters)) {
            $parameters = array_merge($headerParameters, ['json' => $parameters]);
        } else {
            $parameters = $headerParameters;
        }

        $response = $this->client->request(
            'POST',
            $this->config->getDomain() . $uri, $parameters
        );

         switch ($response->getStatusCode()) {
             case self::HTTP_OK:
             case self::HTTP_ACCEPTED:
             case self::HTTP_CREATED:
                 $result = json_decode($response->getBody(), true);
         }

        return $result;
    }

    public function put(string $uri, array $parameters = null): array
    {
        $result = [];

        $headerParameters = [
            'headers' =>
                [
                    'x-api-key' => $this->config->getApiKey()
                ]
        ];

        if (!empty($parameters)) {
            $parameters = array_merge($headerParameters, ['json' => [$parameters]]);
        } else {
            $parameters = $headerParameters;
        }

        $response = $this->client->request(
            'PATCH',
            $this->config->getDomain() . $uri, $parameters
        );

        switch ($response->getStatusCode()) {
            case self::HTTP_OK:
            case self::HTTP_ACCEPTED:
            case self::HTTP_NO_CONTENT:
                $result = json_decode($response->getBody(), true);
        }

        return $result;
    }
}
