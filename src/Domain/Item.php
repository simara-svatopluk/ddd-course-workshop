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
     * @var Crown
     */
    private $price;

    public function __construct(string $text, Crown $price)
    {
        $this->text = $text;
        $this->price = $price;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getPrice(): Crown
    {
        return $this->price;
    }

    public function equals(self $compared): bool
    {
        return
            $this->price->equals($compared->price)
            && $this->text === $compared->text;
    }
}
