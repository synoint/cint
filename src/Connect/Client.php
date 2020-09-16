<?php
namespace Syno\Cint\Connect;

use Syno\Cint\HttpClient;

class Client
{
    const API_DOMAIN = 'https://connect.cint.com';
    const HTTP_OK = 200;

    /** @var int */
    private $accountId;

    /** @var string */
    private $username;

    /** @var string */
    private $password;

    /** @var HttpClient */
    private $client;

    /**
     * @param int           $accountId
     * @param string        $username
     * @param string        $password
     * @param HttpClient    $client
     */
    public function __construct(
        HttpClient  $client,
        int         $accountId,
        string      $username = '',
        string      $password = ''
    )
    {
        $this->client       = $client;
        $this->accountId    = $accountId;
        $this->username     = $username;
        $this->password     = $password;
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
            self::API_DOMAIN . $uri,
            [
                'auth' => [$this->username, $this->password]
            ]
        );

        if (self::HTTP_OK === $response->getStatusCode()) {
            $result = json_decode($response->getBody(), true);
        }

        return $result;
    }

    /**
     * @return int
     */
    public function getAccountId() : int
    {
        return $this->accountId;
    }
}
