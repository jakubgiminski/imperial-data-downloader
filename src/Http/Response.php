<?php declare(strict_types=1);

namespace ExcellenceApi\Http;

class Response
{
    private $body;

    public function __construct(array $body)
    {
        $this->body = $body;
    }
    
    public function getBody(): array
    {
        return $this->body;
    }

    public function getBodyParameter(string $parameterName)
    {
        if (!$this->bodyContains($parameterName)) {
            throw new MissingParameterException($parameterName);
        }

        return $this->body[$parameterName];
    }

    public function bodyContains(string $parameterName): bool
    {
        return array_key_exists($parameterName, $this->body) && $this->body[$parameterName];
    }
}