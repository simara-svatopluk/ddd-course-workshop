<?php

declare(strict_types=1);

namespace DDDWorkshop\Domain\Services;

use DDDWorkshop\Domain\Interfaces\SeriesInterface;
use DDDWorkshop\Domain\ValueObjects\Number;

class Series implements SeriesInterface
{
    /**
     * @return Number
     */
    public function getNextNumber(): Number
    {
        return new Number("VF/0001");
    }
}
