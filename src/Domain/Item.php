<?php

declare(strict_types=1);

namespace DDDWorkshop\Domain;

final class Item
{
    /**
     * @var string
     */
    private $text;

    /**
     * @var float
     */
    private $price;

    public function __construct(string $text, float $price)
    {
        $this->text = $text;
        $this->price = $price;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function isEqual(self $compared): bool
    {
        return
            $this->price === $compared->price
            && $this->text === $compared->text;
    }
}
