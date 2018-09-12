<?php declare(strict_types=1);

namespace ExcellenceApi\Http;

use ExcellenceApi\Authentication\Authentication;
use ExcellenceApi\Authentication\Token;

class Client
{
    private const URL = 'https://death.star.api/';

    private $authentication;

    public function __construct(Authentication $authentication)
    {
        $this->authentication = $authentication;
    }

    public function get(Request $request): Response
    {
        if ($request->getEndpoint() !== '/prisoner/leia') {
            throw new UnknownEndpointException($request->getEndpoint());
        }

        $this->authentication->validateToken(
            $request->getBodyParameter('token')
        );

        return new Response([
            'cell' => '01000011 01100101 01101100 01101100 00100000 00110010 00110001 00111000 00110111',
            'block' => '01000100 01100101 01110100 01100101 01101110 01110100 01101001 01101111 01101110 00100000 01000010 01101100 01101111 01100011 01101011 00100000 01000001 01000001 00101101 00110010 00110011 00101100',
        ]);
    }

    public function post(Request $request): Response
    {
        if ($request->getEndpoint() !== '/token') {
            throw new UnknownEndpointException($request->getEndpoint());
        }

        $this->authentication->validateCredentials(
            $request->getBodyParameter('Client ID'),
            $request->getBodyParameter('Client Secret')
        );

        return new Response(['token' => new Token()]);
    }
}