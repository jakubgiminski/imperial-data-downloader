<?php declare(strict_types=1);

namespace Tests;

use ExcellenceApi\Authentication\Authentication;
use ExcellenceApi\ExecutePlan;
use ExcellenceApi\Http\Client;
use ExcellenceApi\Translator;
use PHPUnit\Framework\TestCase;

class ExecutePlanTest extends TestCase
{
    public function testDownloadsAndTranslatesData(): void
    {
        $executePlan = new ExecutePlan(
            new Client(new Authentication()),
            new Translator()
        );

        $result = $executePlan();

        self::assertArrayHasKey('cell', $result);
        self::assertArrayHasKey('block', $result);
    }
}
