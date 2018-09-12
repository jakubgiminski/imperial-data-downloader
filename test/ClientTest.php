<?php declare(strict_types=1);

namespace Test;

use ExcellenceApi\Authentication\Authentication;
use ExcellenceApi\Authentication\AuthenticationException;
use ExcellenceApi\Client;
use ExcellenceApi\Request;
use ExcellenceApi\Authentication\Token;
use ExcellenceApi\UnknownEndpointException;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    private $client;

    public function setUp(): void
    {
        $this->client = new Client(new Authentication());
    }

    public function testThrowsExceptionForUnknownEndpointOnGet(): void
    {
        $this->expectException(UnknownEndpointException::class);
        $this->client->get(new Request('/unknown/endpoint'));
    }

    public function testThrowsExceptionForUnknownEndpointOnPost(): void
    {
        $this->expectException(UnknownEndpointException::class);
        $this->client->post(new Request('/unknown/endpoint'));
    }

    public function testThrowsExceptionForInvalidCredentials(): void
    {
        $request = new Request(
            '/token',
            [
                'Content-Type' => 'application/x-www-form-urlencoded'
            ],
            [
                'Client ID' => 'invalid id',
                'Client Secret' => 'invalid secret',
            ]
        );

        $this->expectException(AuthenticationException::class);
        $this->client->post($request);
    }

    public function testReturnsTokenForValidCredentials(): void
    {
        $request = new Request(
            '/token',
            [
                'Content-Type' => 'application/x-www-form-urlencoded'
            ],
            [
                'Client ID' => 'R2D2',
                'Client Secret' => 'Alderan',
            ]
        );

        $response = $this->client->post($request);

        self::assertInstanceOf(Token::class, $response->getBody()['token']);
    }
    
    public function testReturnsLeiasCellAndBlock(): void
    {
        $request = new Request(
            '/prisoner/leia',
            [
                'Content-Type' => 'application/json'
            ],
            [
                'token' => new Token(),
            ]
        );

        $responseBody = $this->client->get($request)->getBody();

        self::assertArrayHasKey('cell', $responseBody);
        self::assertArrayHasKey('block', $responseBody);
    }
}