<?php declare(strict_types=1);

namespace ExcellenceApi;

use ExcellenceApi\Http\Client;
use ExcellenceApi\Http\Request;

class DownloadImperialData
{
    private $apiClient;
    
    private $translator;
    
    public function __construct(Client $apiClient, Translator $translator)
    {
        $this->apiClient = $apiClient;
        $this->translator = $translator;
    }
    
    public function __invoke(): array
    {
        // Authenticate
        $request = new Request(
            '/authenticate',
            [
                'Content-Type' => 'application/x-www-form-urlencoded'
            ],
            [
                'username' => 'solo',
                'password' => 'chewy',
            ]
        );

        $authResponse = $this->apiClient->post($request);

        // Get Leia's cell and block numbers
        $request = new Request(
            '/prisoners/leia',
            [
                'Content-Type' => 'application/json',
                'Access-Token' => (string) $authResponse->getBodyParameter('access_token'),
            ]
        );

        $leiaResponse = $this->apiClient->get($request);

        // Translate binary to english
        return [
            'cell' => $this->translator->translateBinary($leiaResponse->getBodyParameter('cell')),
            'block' => $this->translator->translateBinary($leiaResponse->getBodyParameter('block')),
        ];
    }
}