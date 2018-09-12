<?php declare(strict_types=1);

namespace ExcellenceApi\Http;

class MissingParameterException extends \Exception
{
    public function __construct(string $parameter)
    {
        parent::__construct("Parameter missing: $parameter");
    }
}