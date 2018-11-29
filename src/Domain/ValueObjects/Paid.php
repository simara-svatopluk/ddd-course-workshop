<?php

declare(strict_types=1);

namespace DDDWorkshop\Domain\ValueObjects;

class Paid
{
    /**
     * @var bool
     */
    private $is;

    /**
     * @param bool $is
     */
    public function __construct(bool $is)
    {
        $this->is = $is;
    }

    public function is(): bool
    {
        return $this->is;
    }
}
