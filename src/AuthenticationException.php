<?php declare(strict_types=1);

namespace ExcellenceApi;

class AuthenticationException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Invalid Client ID or Client Secret');
    }
}