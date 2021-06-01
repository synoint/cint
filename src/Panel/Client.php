<?php
namespace Syno\Cint\Panel;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;
use Syno\Cint\HttpClient;

class Client
{
    const API_URL = 'https://api.cint.com';

    /** @var HttpClient */
    private $client;

    /**
     * @param HttpClient $client
     */
    public function __construct(HttpClient  $client)
    {
        $this->client = $client;
    }

    /**
     * @return string
     */
    public function getApiUrl() : string
    {
        return self::API_URL;
    }

    /**
     * @param string|UriInterface $uri
     * @param array               $options
     *
     * @return ResponseInterface
     */
    public function getWithRetry(string $uri, array $options = []): ResponseInterface
    {
        $retries = 3;
        $e = new \Exception(sprintf('No response for uri %s', $uri));
        while ($retries--) {
            try {
                return $this->client->get($uri, $options);
            } catch (GuzzleHttp\Exception\RequestException $e) {
                sleep(2);
            }
        }

        throw $e;
    }

    public function post(string $uri, array $parameters = null): ResponseInterface
    {
        return $this->client->post($uri, $parameters);
    }

    public function patch(string $uri, array $parameters = null): ResponseInterface
    {
        return $this->client->patch($uri, $parameters);
    }

    public function delete(string $uri, array $parameters = null): ResponseInterface
    {
        return $this->client->delete($uri, $parameters);
    }
}
