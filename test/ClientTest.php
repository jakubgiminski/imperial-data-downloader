<?php declare(strict_types=1);

namespace Test;

use ExcellenceApi\Client;
use ExcellenceApi\Request;
use ExcellenceApi\UnknownEndpointException;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    public function testThrowsExceptionForUnknownEndpointOnGet(): void
    {
        $client = new Client();
        $this->expectException(UnknownEndpointException::class);
        $client->get(new Request('/unknown/endpoint'));
    }

    public function testThrowsExceptionForUnknownEndpointOnPost(): void
    {
        $client = new Client();
        $this->expectException(UnknownEndpointException::class);
        $client->post(new Request('/unknown/endpoint'));
    }
}