<?php

declare(strict_types=1);

namespace DDDWorkshop\Infrastructure;

use DDDWorkshop\Domain\Series;
use DDDWorkshop\Domain\SeriesTest;

final class MemorySeriesTest extends SeriesTest
{
    protected function getSeries(): Series
    {
        return new MemorySeries('2018');
    }
}
