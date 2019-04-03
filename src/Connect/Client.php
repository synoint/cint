<?php
namespace Syno\Cint\Connect;

use Syno\Cint\HttpClient;

class Client
{
    const HTTP_OK = 200;

    /** @var Config */
    private $config;

    /** @var HttpClient */
    private $client;

    /**
     * @param Config     $config
     * @param HttpClient $client
     */
    public function __construct(Config $config, HttpClient $client)
    {
        $this->config = $config;
        $this->client = $client;
    }

    /**
     * @param string $uri
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
