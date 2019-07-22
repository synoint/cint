<?php
namespace Syno\Cint\Demand;

class Config
{
    const API_DOMAIN = 'https://api.cintworks.net';

    /** @var string */
    private $apiKey;

    /**
     * @param string $apiKey
     */
    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @return string
     */
    public function getDomain(): string
    {
        return self::API_DOMAIN;
    }

    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }
}