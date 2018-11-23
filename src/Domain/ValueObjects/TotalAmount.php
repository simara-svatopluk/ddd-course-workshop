<?php

declare(strict_types=1);

namespace DDDWorkshop\Domain\ValueObjects;

class TotalAmount
{
    private $amount;

    /**
     * TotalAmount constructor.
     * @param float $amount
     */
    public function __construct(float $amount = 0)
    {
        $this->amount = $amount;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     */
    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }


    public function toFloat(): float
    {
        return $this->amount;
    }
}
