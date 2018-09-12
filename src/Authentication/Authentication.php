<?php declare(strict_types=1);

namespace ExcellenceApi\Authentication;

class Authentication 
{
    public function validateCredentials(string $clientId, string $clientSecret): void
    {
        if ($clientId !== Credentials::CLIENT_ID || $clientSecret !== Credentials::CLIENT_SECRET) {
            throw AuthenticationException::invalidCredentials();
        }
    }
    
    public function validateToken(Token $token): void
    {
        if (!$token::VALUE) {
            throw AuthenticationException::missingToken();
        }
    }
}