<?php

declare(strict_types=1);

namespace DDDWorkshop\Domain;

final class IssuedInvoice
{
    /**
     * @var \DDDWorkshop\Domain\Number
     */
    private $number;

    /**
     * @var Items
     */
    private $items;

    public function __construct(Series $series, array $items)
    {
        $this->number = $series->next();
        $this->items = new Items($items);
    }

    public function getItems(): array
    {
        return $this->items->getItems();
    }

    public function addItem(Item $item): void
    {
        $this->items = $this->items->add($item);
    }

    public function removeItem(Item $itemToRemove): void
    {
        $this->items = $this->items->remove($itemToRemove);
    }

    public function getNumber(): Number
    {
        return $this->number;
    }
}
