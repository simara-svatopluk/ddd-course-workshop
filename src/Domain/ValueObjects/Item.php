<?php

declare(strict_types=1);

namespace DDDWorkshop\Domain\ValueObjects;

class Item
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var int
     */
    private $quantity;
    /**
     * @var float
     */
    private $amount;

    /**
     * @param string $name
     * @param int $quantity
     * @param float $amount
     */
    public function __construct(string $name, int $quantity, float $amount)
    {
        $this->name = $name;
        $this->quantity = $quantity;
        $this->amount = $amount;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return float
     */
    public function getTotalAmount(): float
    {
        return (float)$this->quantity * $this->amount;
    }
}
