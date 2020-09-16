<?php

namespace Syno\Cint\Demand;

use Psr\Http\Message\ResponseInterface;
use Syno\Cint\HttpClient;
use GuzzleHttp\Exception\RequestException;

class Client
{
    const REQUEST_GET       = 'GET';
    const REQUEST_POST      = 'POST';
    const REQUEST_PATCH     = 'PATCH';
    const REQUEST_DELETE    = 'DELETE';

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
        return $this->request(self::REQUEST_GET, $uri, $parameters);
    }

    /**
     * @param string $uri
     * @param array $parameters
     *
     * @return array
     */
    public function post(string $uri, array $parameters = null): array
    {
        return $this->request(self::REQUEST_POST, $uri, $parameters);
    }

    /**
     * @param string $uri
     * @param array $parameters
     *
     * @return array
     */
    public function patch(string $uri, array $parameters = null): array
    {
        return $this->request(self::REQUEST_PATCH, $uri, $parameters);
    }

    /**
     * @param string $uri
     * @param array $parameters
     *
     * @return array
     */
    public function delete(string $uri, array $parameters = null): array
    {
        return $this->request(self::REQUEST_DELETE, $uri, $parameters);
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
            $parameters = array_merge($headerParameters, [($requestType == self::REQUEST_GET ? 'query' : 'json') => $parameters]);
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
        if(!empty($response->getBody())){
            $result = json_decode($response->getBody(), true);
        } else {
            $result = [true];
        }

        return $result;
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

        return $result;
    }
}
