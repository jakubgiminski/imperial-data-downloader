<?php declare(strict_types=1);

namespace ExcellenceApi\Http;

class UnknownEndpointException extends \Exception
{
    public function __construct(string $endpoint)
    {
        parent::__construct("Unknown endpoint: $endpoint");
    }
}