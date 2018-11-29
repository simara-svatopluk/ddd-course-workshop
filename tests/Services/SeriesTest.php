<?php

declare(strict_types=1);

namespace DDDWorkshop\Services;

use DDDWorkshop\Domain\ValueObjects\OrderNumber;
use DDDWorkshop\Fixtures\StaticSeries;
use PHPUnit\Framework\TestCase;

class SeriesTest extends TestCase
{
    /**
     * @test
     */
    public function itCanGetNextNumber(): void
    {
        $series = new StaticSeries();

        $this->assertInstanceOf(OrderNumber::class, $series->getNextNumber());
    }
}
