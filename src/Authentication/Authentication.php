<?php declare(strict_types=1);

namespace ExcellenceApi\Authentication;

class Authentication 
{
    public function validateCredentials(string $username, string $password): void
    {
        if ($username !== Credentials::USERNAME || $password !== Credentials::PASSWORD) {
            throw AuthenticationException::invalidCredentials();
        }
    }

    public function validateToken(Token $token): void
    {
        if (!(string)$token) {
            throw AuthenticationException::missingToken();
        }
    }
}