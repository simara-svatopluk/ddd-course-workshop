<?php

declare(strict_types=1);

namespace DDDWorkshop\Domain;

final class Items
{
    /**
     * @var Item[]
     */
    private $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function getItems(): array
    {
        return array_values($this->items);
    }

    public function add(Item $item): self
    {
        $items = $this->items;
        $items[] = $item;
        return new self($items);
    }

    public function remove(Item $itemToRemove): self
    {
        $items = $this->items;
        foreach ($items as $key => $item) {
            if ($item->equals($itemToRemove)) {
                unset($items[$key]);
                return new self($items);
            }
        }

        throw new Exception('Item not found');
    }
}
