<?php declare(strict_types=1);

namespace ExcellenceApi;

class Client
{
    private const URL = 'https://death.star.api/';

    private const CREDENTIALS = [
        'Client ID' => 'R2D2',
        'Client Secret' => 'Alderan',
    ];

    public function get(Request $request): Response
    {
        if ($request->getEndpoint() !== '/prisoner/leia') {
            throw new UnknownEndpointException($request->getEndpoint());
        }

        // @todo
    }

    public function post(Request $request): Response
    {
        if ($request->getEndpoint() !== '/token') {
            throw new UnknownEndpointException($request->getEndpoint());
        }

        $this->validateCredentials($request);

        return new Response([
            'access_token' => 'e31a726c4b90462ccb7619e1b51f3d0068bf8006',
            'expires_in' => 99999999999,
            'token_type' => 'Bearer',
            'scope' => 'TheForce',
        ]);
    }

    private function validateCredentials(Request $request): void
    {
        foreach (self::CREDENTIALS as $key => $value) {
            if ($request->getBodyParameter($key) !== $value) {
                throw new AuthenticationException();
            }
        }
    }
}