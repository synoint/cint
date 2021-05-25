<?php

namespace Syno\Cint\Traits;

trait StatusCodes
{
    /**
     * Successful 2xx
     */
    public $HTTP_OK = 200;

    /**
     * Client Error 4xx
     */
    public $HTTP_BAD_REQUEST = 400;
    public $HTTP_UNAUTHORIZED  = 401;
    public $HTTP_FORBIDDEN = 403;
    public $HTTP_NOT_FOUND = 404;
    public $HTTP_METHOD_NOT_ALLOWED = 422;

    /**
     * Server Error 5xx
     */
    public $HTTP_INTERNAL_SERVER_ERROR = 500;
}