<?php

declare(strict_types=1);

namespace DDDWorkshop\Services;

use DDDWorkshop\Domain\Services\Series;
use DDDWorkshop\Domain\ValueObjects\OrderNumber;
use PHPUnit\Framework\TestCase;

class SeriesTest extends TestCase
{
    /**
     * @test
     */
    public function itCanGetNextNumber():void
    {
        $series = new Series();

        $this->assertInstanceOf(OrderNumber::class, $series->getNextNumber());
    }
}
