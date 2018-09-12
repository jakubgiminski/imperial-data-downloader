<?php declare(strict_types=1);

namespace ExcellenceApi;

class Translator
{
    public function translateBinary(string $value): string
    {
        return pack(
            'H*',
            base_convert($value, 2, 16)
        );
    }
}