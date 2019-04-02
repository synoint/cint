<?php
namespace Syno\Cint\Connect;

class Config
{
    const API_DOMAIN = 'https://connect.cint.com';

    /** @var string */
    private $accountId;

    /** @var string */
    private $username;

    /** @var string */
    private $password;

    /**
     * @param string $accountId
     * @param string $username
     * @param string $password
     */
    public function __construct(string $accountId, string $username, string $password)
    {
        $this->accountId = $accountId;
        $this->username  = $username;
        $this->password  = $password;
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
