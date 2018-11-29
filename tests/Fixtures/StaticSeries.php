<?php

declare(strict_types=1);

namespace DDDWorkshop\Fixtures;

use DDDWorkshop\Domain\Interfaces\SeriesInterface;
use DDDWorkshop\Domain\ValueObjects\OrderNumber;

class StaticSeries implements SeriesInterface
{
    public function getNextNumber(): OrderNumber
    {
        return new OrderNumber('VF/0001');
    }
}
