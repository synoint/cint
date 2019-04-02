<?php
namespace Syno\Cint\Connect;

use GuzzleHttp;

class Client
{
    const HTTP_OK = 200;

    /** @var Config */
    private $config;

    /** @var GuzzleHttp\ClientInterface */
    private $client;

    /**
     * @param Config                     $config
     * @param GuzzleHttp\ClientInterface $client
     */
    public function __construct(Config $config, GuzzleHttp\ClientInterface $client)
    {
        $this->config = $config;
        $this->client = $client;
    }

    /**
     * @param string $uri
     *
     * @throws GuzzleHttp\Exception\GuzzleException
     *
     * @return array
     */
    public function get(string $uri) : array
    {
        $result = [];

        $response = $this->client->request(
            'GET',
            $this->config->getDomain() . $uri,
            [
                'auth' => [$this->config->getUsername(), $this->config->getPassword()]
            ]
        );

        if (self::HTTP_OK === $response->getStatusCode()) {
            $result = json_decode($response->getBody(), true);
        }

        return $result;
    }

}
