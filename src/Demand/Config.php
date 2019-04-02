<?php
namespace Syno\Cint\Demand;

class Config
{
    /** @var string */
    private $domain;

    /** @var string */
    private $apiKey;

    /**
     * @param string $domain
     * @param string $apiKey
     */
    public function __construct(string $domain, string $apiKey)
    {
        $this->domain = $domain;
        $this->apiKey = $apiKey;
    }

    /**
     * @return string
     */
    public function getDomain(): string
    {
        return $this->domain;
    }

    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }
}
