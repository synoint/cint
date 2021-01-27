<?php

namespace Syno\Cint\Demand;

use Psr\Http\Message\ResponseInterface;
use Syno\Cint\HttpClient;
use GuzzleHttp\Exception\RequestException;

class Client
{
    /** @var string */
    private $apiDomain;

    /** @var string */
    private $apiKey;

    /** @var HttpClient */
    private $client;

    /**
     * @param HttpClient    $client
     * @param string        $apiDomain
     * @param string        $apiKey
     */
    public function __construct(
        HttpClient  $client,
        string      $apiDomain = '',
        string      $apiKey = ''
    )
    {
        $this->apiDomain    = $apiDomain;
        $this->apiKey       = $apiKey;
        $this->client       = $client;
    }

    /**
     * @param string $apiKey
     */
    public function setApiKey(string $apiKey)
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * @param string $uri
     * @param array $parameters
     *
     * @return array
     */
    public function get(string $uri, array $parameters = null): array
    {
        return $this->request('GET', $uri, $parameters);
    }

    /**
     * @param string $uri
     * @param array $parameters
     *
     * @return array
     */
    public function post(string $uri, array $parameters = null): array
    {
        return $this->request('POST', $uri, $parameters);
    }

    /**
     * @param string $uri
     * @param array $parameters
     *
     * @return array
     */
    public function patch(string $uri, array $parameters = null): array
    {
        return $this->request('PATCH', $uri, $parameters);
    }

    /**
     * @param string $uri
     * @param array $parameters
     *
     * @return array
     */
    public function put(string $uri, array $parameters = null): array
    {
        return $this->request('PUT', $uri, $parameters);
    }

    /**
     * @param string $uri
     * @param array $parameters
     *
     * @return array
     */
    public function delete(string $uri, array $parameters = null): array
    {
        return $this->request('DELETE', $uri, $parameters);
    }

    /**
     * @param string $requestType
     * @param string $url
     * @param array $parameters
     *
     * @return array
     */
    private function request(string $requestType, string $url, ?array $parameters): array
    {
        try {
            $response = $this->client->request(
                $requestType,
                $this->apiDomain . $url, $this->setParameters($requestType, $parameters)
            );

            $result = $this->getSuccessResponse($response);

        } catch (RequestException $exception) {
            $result = $this->getErrorResponse($exception->getResponse());
        }

        return $result;
    }

    /**
     * @param string $requestType
     * @param string $parameters
     *
     * @return array
     */
    private function setParameters(string $requestType, ?array $parameters): array
    {
        $headerParameters = [
            'headers' =>
                [
                    'x-api-key' => $this->apiKey
                ]
        ];

        if (!empty($parameters)) {
            $parameters = array_merge($headerParameters, [($requestType == 'GET' ? 'query' : 'json') => $parameters]);
        } else {
            $parameters = $headerParameters;
        }

        return $parameters;
    }

    /**
     * @param ResponseInterface $response
     *
     * @return array
     */
    private function getSuccessResponse(ResponseInterface $response): array
    {
        $result = json_decode($response->getBody()->getContents(), true);
        return $result !== null ? $result : [];
    }

    /**
     * @param ResponseInterface $response
     *
     * @return array
     */
    private function getErrorResponse(ResponseInterface $response): array
    {
        $result = json_decode($response->getBody()->getContents(), true);

        if(isset($result['message'])) {
            $result = ['errors'=>[['field' => '', 'message' => $result['message']]]];
        }

        return $result !== null ? $result : [];
    }
}
