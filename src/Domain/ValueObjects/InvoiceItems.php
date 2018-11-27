<?php

declare(strict_types=1);

namespace DDDWorkshop\Domain\ValueObjects;

use InvalidArgumentException;
use function array_reduce;
use function count;
use function get_class;
use function sprintf;

class InvoiceItems
{
    /**
     * @var array|InvoiceItem[]
     */
    private $items;

    /**
     * InvoiceItems constructor.
     * @param array|InvoiceItem[] $items
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
        if (!$item instanceof InvoiceItem) {
            throw new InvalidArgumentException(
                sprintf('Item must be instance of %s but is instance of %s', InvoiceItem::class, get_class($item))
            );
        }
    }

    public function add(InvoiceItem $item): InvoiceItems
    {
        $items = $this->items;
        $items[] = $item;

        return new InvoiceItems(
            $items
        );
    }

    /**
     * @return array|InvoiceItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->items);
    }

    /**
     * @return TotalAmount
     */
    public function totalAmount(): TotalAmount
    {
        $total = (float)array_reduce($this->items, function (?int $carry, InvoiceItem $item) {
            $carry += $item->getTotalAmount();

            return $carry;
        });

        return new TotalAmount($total);
    }
}
