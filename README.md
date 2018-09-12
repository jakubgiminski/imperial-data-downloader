# bud-interview
[Bud Interview Assignment](https://github.com/jakubgiminski/bud-interview/blob/master/TASK.md)

### Installation
```
composer install
```

### Execute tests
```
vendor/bin/phpunit test --testdox
```

```php
class ExecutePlan 
{
    private $apiClient;
    
    private $translator;
    
    public function __construct(Client $apiClient, Translator $translator)
    {
        $this->apiClient = $apiClient;
        $this->translator = $translator;
    }
    
    public function __invoke()
    {
        // Authenticate
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
        $authResponse = $this->apiClient->post($request);

        // Get Leia's cell and block numbers
        $request = new Request(
            '/prisoner/leia',
            [
                'Content-Type' => 'application/json'
            ],
            [
                'token' => $authResponse->getBodyParameter('token'),
            ]
        );
        $leiaResponse = $this->apiClient->get($request);

        // Translate binary to english
        return [
            'cell' => $this->translator->translateBinary($leiaResponse->getBodyParameter('cell')),
            'block' => $this->translator->translateBinary($leiaResponse->getBodyParameter('block')),
        ];
    }
```
