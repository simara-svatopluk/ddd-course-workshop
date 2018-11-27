<?php

declare(strict_types=1);

namespace DDDWorkshop\Domain\Interfaces;

use DDDWorkshop\Domain\ValueObjects\OrderNumber;

interface SeriesInterface
{
    /**
     * @return OrderNumber
     */
    public function getNextNumber(): OrderNumber;
}
