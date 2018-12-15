<?php

declare(strict_types=1);

namespace DDDWorkshop\Infrastructure;

use DDDWorkshop\Domain\Number;
use DDDWorkshop\Domain\Series;

final class MemorySeries implements Series
{
    /**
     * @var int
     */
    private $counter = 1;

    /**
     * @var string
     */
    private $prefix;

    public function __construct(string $prefix)
    {
        $this->prefix = $prefix;
    }

    public function next(): Number
    {
        $counter = $this->counter++;
        return new Number($this->prefix, (string) $counter);
    }
}
