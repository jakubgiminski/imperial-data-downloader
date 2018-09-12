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
}