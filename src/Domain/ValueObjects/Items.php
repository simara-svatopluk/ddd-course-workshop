<?php

declare(strict_types=1);

namespace DDDWorkshop\Domain\ValueObjects;

use InvalidArgumentException;
use function array_reduce;
use function get_class;
use function sprintf;

class Items
{
    /**
     * @var array|Item[]
     */
    private $items;

    /**
     * @param array|Item[] $items
     */
    public function __construct(array $items = [])
    {
        $this->items = $this->validate($items);
    }

    protected function validate(array $items): array
    {
        foreach ($items as $item) {
            $this->checkItemType($item);
        }
        return $items;
    }

    /**
     * @param mixed $item
     */
    protected function checkItemType($item): void
    {
        if (!$item instanceof Item) {
            throw new InvalidArgumentException(
                sprintf('Item must be instance of %s but is instance of %s', Item::class, get_class($item))
            );
        }
    }

    public function add(Item $item): Items
    {
        $items = $this->items;
        $items[] = $item;

        return new Items(
            $items
        );
    }

    /**
     * @return array|Item[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @return TotalAmount
     */
    public function totalAmount(): TotalAmount
    {
        $total = (float)array_reduce($this->items, function (float $carry, Item $item) {
            $carry += $item->getTotalAmount();

            return $carry;
        }, 0);

        return new TotalAmount($total);
    }
}
