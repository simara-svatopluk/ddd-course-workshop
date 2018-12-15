<?php

declare(strict_types=1);

namespace DDDWorkshop\Infrastructure;

use DDDWorkshop\Domain\Number;
use DDDWorkshop\Domain\Series;
use DDDWorkshop\Domain\SeriesTest;

final class StaticSeriesTest extends SeriesTest
{
    protected function getSeries(): Series
    {
        $this->markTestSkipped();
        return new StaticSeries(new Number('', '1'));
    }
}
