<?php
namespace Syno\Cint\Demand;

class Config
{
    /** @var string */
    private $apiDomain;
    /** @var string */
    private $apiKey;

    /**
     * @param string $apiDomain
     * @param string $apiKey
     */
    public function __construct(string $apiDomain = '', string $apiKey = '')
    {
        $this->apiDomain = $apiDomain;
        $this->apiKey    = $apiKey;
    }

    /**
     * @return string
     */
    public function getDomain(): string
    {
        return $this->apiDomain;
    }

    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }
}
