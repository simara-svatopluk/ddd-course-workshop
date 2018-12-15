<?php

declare(strict_types=1);

namespace DDDWorkshop\Infrastructure;

use DDDWorkshop\Domain\Number;
use DDDWorkshop\Domain\Series;

final class StaticSeries implements Series
{
    /**
     * @var \DDDWorkshop\Domain\Number
     */
    private $number;

    public function __construct(Number $number)
    {
        $this->number = $number;
    }

    public function next(): Number
    {
        return $this->number;
    }
}
