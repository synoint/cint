<?php
namespace Syno\Cint\ProfilingData;

class Config
{
    /** @var string */
    private $domain;

    /** @var string */
    private $apiKey;

    /** @var string */
    private $username;

    /** @var string */
    private $password;

    /**
     * @param string $domain
     * @param string $apiKey
     * @param string $username
     * @param string $password
     */
    public function __construct(string $domain, string $apiKey, string $username, string $password)
    {
        $this->domain   = $domain;
        $this->apiKey   = $apiKey;
        $this->username = $username;
        $this->password = $password;
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
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

}
