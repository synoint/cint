<?php

namespace Syno\Cint\Demand;

use Syno\Cint\HttpClient;
use Guzzle\Http\Exception\ClientException;

class Client
{
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

        try {
            $response = $this->client->request(
                'GET',
                $this->config->getDomain() . $uri, $parameters
            );

            $result = json_decode($response->getBody(), true);

        } catch (\GuzzleHttp\Exception\RequestException $e) {
            $result = json_decode($e->getResponse()->getBody()->getContents(), true);
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

        try {
            $response = $this->client->request(
                'POST',
                $this->config->getDomain() . $uri, $parameters
            );

            $result = json_decode($response->getBody(), true);

        } catch (\GuzzleHttp\Exception\RequestException $e) {
            $result = json_decode($e->getResponse()->getBody()->getContents(), true);
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

        try{
            $response = $this->client->request(
                'PATCH',
                $this->config->getDomain() . $uri, $parameters
            );

            $result = json_decode($response->getBody(), true);
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            $result = json_decode($e->getResponse()->getBody()->getContents(), true);
        }

        return $result;
    }
}
