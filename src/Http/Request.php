<?php declare(strict_types=1);

namespace ExcellenceApi\Http;

class Request
{
    private $endpoint;

    private $headers;

    private $body;

    public function __construct(string $endpoint, array $headers = [], array $body = [])
    {
        $this->endpoint = $endpoint;
        $this->headers = $headers;
        $this->body = $body;
    }

    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    public function getHeader(string $key): string
    {
        if (!isset($this->headers[$key])) {
            throw new \InvalidArgumentException($key);
        }
        return $this->headers[$key];
    }

    public function getHeaders(): array
    {
        return $this->headers;
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