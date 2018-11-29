<?php

declare(strict_types=1);

namespace DDDWorkshop\Domain;

use DDDWorkshop\Domain\ValueObjects\Item;
use DDDWorkshop\Domain\ValueObjects\Items;
use PHPUnit\Framework\TestCase;

class ItemsTest extends TestCase
{
    /**
     * @test
     */
    public function itCanCreateItselfGivenArrayOfInvoiceItem(): void
    {
        $items = [
            new Item("Polozka faktury", 2, 100),
            new Item("Dalsi polozka faktury", 1, 50)
        ];
        $invoiceItems = new Items($items);

        $this->assertInstanceOf(Items::class, $invoiceItems);
    }

    /**
     * @test
     */
    public function itCanAddItem(): void
    {
        $invoiceItems = new Items();

        $this->assertCount(0, $invoiceItems->getItems());

        $invoiceItems = $invoiceItems->add(new Item("Polozka", 1, 300));
        $this->assertCount(1, $invoiceItems->getItems());

        $invoiceItems = $invoiceItems->add(new Item("Polozka 2", 1, 300));
        $this->assertCount(2, $invoiceItems->getItems());
    }

    /**
     * @test
     */
    public function itCanGetTotalAmount(): void
    {
        $invoiceItems = new Items();

        $this->assertCount(0, $invoiceItems->getItems());

        $invoiceItems = $invoiceItems->add(new Item("Polozka", 1, 300));
        $this->assertCount(1, $invoiceItems->getItems());

        $invoiceItems = $invoiceItems->add(new Item("Polozka 2", 3, 300));
        $this->assertCount(2, $invoiceItems->getItems());

        $this->assertEquals(
            1200,
            $invoiceItems->totalAmount()->getAmount()
        );
    }

    /**
     * @test
     */
    public function itIsImmutable(): void
    {
        $invoiceItems = new Items([
            new Item('1', 1, 100),
            new Item('2', 1, 150)
        ]);
        $this->assertCount(2, $invoiceItems->getItems());

        $invoiceItems->add(new Item('3', 1, 50));

        $this->assertCount(2, $invoiceItems->getItems());
    }
}
