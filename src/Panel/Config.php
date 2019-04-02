<?php
namespace Syno\Cint\Panel;

class Config
{
    /** @var string */
    private $domain;

    /** @var string */
    private $apiKey;

    /** @var string */
    private $secret;

    /**
     * @param string $domain
     * @param string $apiKey
     * @param string $secret
     */
    public function __construct(string $domain, string $apiKey, string $secret)
    {
        $this->domain = $domain;
        $this->apiKey = $apiKey;
        $this->secret = $secret;
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

    /**
     * @return string
     */
    public function getSecret(): string
    {
        return $this->secret;
    }
}
