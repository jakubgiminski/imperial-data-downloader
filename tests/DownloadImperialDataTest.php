<?php declare(strict_types=1);

namespace Tests;

use ExcellenceApi\Authentication\Authentication;
use ExcellenceApi\DownloadImperialData;
use ExcellenceApi\Http\Client;
use ExcellenceApi\Translator;
use PHPUnit\Framework\TestCase;

class DownloadImperialDataTest extends TestCase
{
    public function testDownloadsAndTranslatesData(): void
    {
        $executePlan = new DownloadImperialData(
            new Client(new Authentication()),
            new Translator()
        );

        $result = $executePlan();

        self::assertArrayHasKey('cell', $result);
        self::assertArrayHasKey('block', $result);
    }
}
