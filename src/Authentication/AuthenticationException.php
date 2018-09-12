<?php declare(strict_types=1);

namespace ExcellenceApi\Authentication;

class AuthenticationException extends \Exception
{
    public static function invalidCredentials(): self
    {
        return new self('Invalid Client ID or Client Secret');
    }

    public static function missingToken(): self
    {
        return new self('Token is missing');
    }
}