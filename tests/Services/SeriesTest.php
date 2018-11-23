<?php

declare(strict_types=1);

namespace DDDWorkshop\Services;

use DDDWorkshop\Domain\Services\Series;
use DDDWorkshop\Domain\ValueObjects\Number;
use PHPUnit\Framework\TestCase;

class SeriesTest extends TestCase
{
    /**
     * @test
     */
    public function itCanGetNextNumber()
    {
        $series = new Series();

        $this->assertInstanceOf(Number::class, $series->getNextNumber());
    }
}
