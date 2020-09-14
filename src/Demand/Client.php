<?php

namespace Syno\Cint\Demand;

use Psr\Http\Message\ResponseInterface;
use Syno\Cint\HttpClient;
use Guzzle\Http\Exception\ClientException;

class Client
{
    const DEMAND_API_ERROR_MESSAGE      = "Unable to get response from Cint Demand API";
    const DEMAND_API_NOT_FOUND_MESSAGE  = "Not found";

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

            $result = $this->getResponse($response);

        } catch (\GuzzleHttp\Exception\RequestException $e) {

            $responseInJason = $e->getResponse()->getBody()->getContents();

            if(!empty($responseInJason)) {
                $result = json_decode($responseInJason, true);
            } else {
                $result = ['errors'=>[['field' => '', 'message' => self::DEMAND_API_ERROR_MESSAGE]]];
            }
        }

        return $result;
    }

    public function post(string $uri, array $parameters = null): array
    {
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

            $result = $this->getResponse($response);

        } catch (\GuzzleHttp\Exception\RequestException $e) {

            $responseInJason = $e->getResponse()->getBody()->getContents();

            if(!empty($responseInJason)) {
                $result = json_decode($responseInJason, true);
            } else {
                $result = ['errors'=>[['field' => '', 'message' => self::DEMAND_API_ERROR_MESSAGE]]];
            }
        }

        return $result;
    }

    public function patch(string $uri, array $parameters = null): array
    {
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

        try{
            $response = $this->client->request(
                'PATCH',
                $this->config->getDomain() . $uri, $parameters
            );

            $result = $this->getResponse($response);

        } catch (\GuzzleHttp\Exception\RequestException $e) {

            $responseInJason = $e->getResponse()->getBody()->getContents();

            if(!empty($responseInJason)) {
                $result = json_decode($responseInJason, true);
            } else {
                $result = ['errors'=>[['field' => '', 'message' => self::DEMAND_API_ERROR_MESSAGE]]];
            }
        }

        return $result;
    }

    public function delete(string $uri, array $parameters = null): array
    {
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
                'DELETE',
                $this->config->getDomain() . $uri, $parameters
            );

            $result = $this->getResponse($response);

        } catch (\GuzzleHttp\Exception\RequestException $e) {

            $responseInJason = $e->getResponse()->getBody()->getContents();

            if (!empty($responseInJason)) {
                $result = json_decode($responseInJason, true);
            } else {
                $result = ['errors' => [['field' => '', 'message' => self::DEMAND_API_ERROR_MESSAGE]]];
            }
        }

        return $result;
    }

    private function getResponse(ResponseInterface $response): array
    {
        $result = [];

        switch ($response->getStatusCode()) {
            case 200:
            case 201:
            case 202:
                $result = json_decode($response->getBody(), true);
                break;
            case 204:
            case 205:
                $result[] = true;
                break;
            case 404:
                $result = ['errors'=>[['field' => '', 'message' => self::DEMAND_API_NOT_FOUND_MESSAGE]]];
                break;
            case 500:
                $result = ['errors'=>[['field' => '', 'message' => self::DEMAND_API_ERROR_MESSAGE]]];
                break;
        }

        return $result;
    }
}
