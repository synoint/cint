<?php
namespace Syno\Cint\Connect;

class Config
{
    const API_DOMAIN = 'https://connect.cint.com';

    /** @var int */
    private $accountId;

    /** @var string */
    private $username;

    /** @var string */
    private $password;

    /**
     * @param int    $accountId
     * @param string $username
     * @param string $password
     */
    public function __construct(int $accountId = 0, string $username = '', string $password = '')
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
     * @return int
     */
    public function getAccountId() : int
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
