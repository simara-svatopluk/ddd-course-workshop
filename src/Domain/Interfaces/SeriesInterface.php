<?php

declare(strict_types=1);

namespace DDDWorkshop\Domain\Interfaces;

use DDDWorkshop\Domain\ValueObjects\Number;

interface SeriesInterface
{
    /**
     * @return Number
     */
    public function getNextNumber(): Number;
}
