<?php declare(strict_types=1);

namespace Test;

use ExcellenceApi\Translator;
use PHPUnit\Framework\TestCase;

class TranslatorTest extends TestCase
{
    public function testTranslatesBinary(): void
    {
        $translator = new Translator();
        self::assertSame(
            'Stack',
            $translator->translateBinary('0101001101110100011000010110001101101011')
        );
    }
}