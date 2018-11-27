<?php

declare(strict_types=1);

namespace DDDWorkshop\Domain\Services;

use DDDWorkshop\Domain\Interfaces\SeriesInterface;
use DDDWorkshop\Domain\ValueObjects\OrderNumber;

class Series implements SeriesInterface
{
    public function getNextNumber(): OrderNumber
    {
        return new OrderNumber("VF/0001");
    }
}
