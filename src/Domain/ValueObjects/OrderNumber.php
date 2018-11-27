<?php

declare(strict_types=1);

namespace DDDWorkshop\Domain\ValueObjects;

class OrderNumber
{
    /**
     * @var string
     */
    private $number;

    /**
     * NumberTest constructor.
     * @param string $number
     */
    public function __construct(string $number)
    {
        $this->number = $number;
    }

    /**
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }
}
