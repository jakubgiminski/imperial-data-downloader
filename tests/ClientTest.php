<?php declare(strict_types=1);

namespace Tests;

use ExcellenceApi\Authentication\Authentication;
use ExcellenceApi\Authentication\AuthenticationException;
use ExcellenceApi\Authentication\Credentials;
use ExcellenceApi\Http\Client;
use ExcellenceApi\Http\Request;
use ExcellenceApi\Authentication\Token;
use ExcellenceApi\Http\UnknownEndpointException;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    private $apiClient;

    public function setUp(): void
    {
        $this->apiClient = new Client(new Authentication());
    }

    public function testThrowsExceptionForUnknownEndpointOnGet(): void
    {
        $this->expectException(UnknownEndpointException::class);
        $this->apiClient->get(new Request('/unknown/endpoint'));
    }

    public function testThrowsExceptionForUnknownEndpointOnPost(): void
    {
        $this->expectException(UnknownEndpointException::class);
        $this->apiClient->post(new Request('/unknown/endpoint'));
    }

    public function testThrowsExceptionForInvalidCredentials(): void
    {
        $request = new Request(
            '/authenticate',
            [
                'Content-Type' => 'application/x-www-form-urlencoded'
            ],
            [
                'username' => 'invalid id',
                'password' => 'invalid secret',
            ]
        );

        $this->expectException(AuthenticationException::class);
        $this->apiClient->post($request);
    }

    public function testReturnsTokenForValidCredentials(): void
    {
        $request = new Request(
            '/authenticate',
            [
                'Content-Type' => 'application/x-www-form-urlencoded'
            ],
            [
                'username' => Credentials::USERNAME,
                'password' => Credentials::PASSWORD,
            ]
        );

        $response = $this->apiClient->post($request);

        self::assertInstanceOf(Token::class, $response->getBodyParameter('access_token'));
    }
    
    public function testReturnsLeiasCellAndBlock(): void
    {
        $request = new Request(
            '/prisoners/leia',
            [
                'Content-Type' => 'application/json',
                'Access-Token' => 'e31a726c4b90462ccb7619e1b51f3d0068bf8006',
            ]
        );

        $responseBody = $this->apiClient->get($request)->getBody();

        self::assertArrayHasKey('cell', $responseBody);
        self::assertArrayHasKey('block', $responseBody);
    }
}