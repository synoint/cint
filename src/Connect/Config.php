<?php
namespace Syno\Cint\Connect;

class Config
{
    /** @var string */
    private $domain;

    /** @var string */
    private $accountId;

    /** @var string */
    private $username;

    /** @var string */
    private $password;

    /**
     * @param string $domain
     * @param string $accountId
     * @param string $username
     * @param string $password
     */
    public function __construct(string $domain, string $accountId, string $username, string $password)
    {
        $this->domain    = $domain;
        $this->accountId = $accountId;
        $this->username  = $username;
        $this->password  = $password;
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
    public function getAccountId() : string
    {
        return $this->accountId;
    }

    /**
     * @return string
     */
    public function getUsername() : string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword() : string
    {
        return $this->password;
    }
}
