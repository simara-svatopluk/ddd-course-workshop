<?php

declare(strict_types=1);

namespace DDDWorkshop\Domain;

use DDDWorkshop\Domain\ValueObjects\InvoiceItem;
use DDDWorkshop\Domain\ValueObjects\InvoiceItems;
use PHPUnit\Framework\TestCase;

class InvoiceItemsTest extends TestCase
{
    /**
     * @test
     */
    public function itCanCreateItselfGivenArrayOfInvoiceItem()
    {
        $items = [
            new InvoiceItem("Polozka faktury", 2, 100),
            new InvoiceItem("Dalsi polozka faktury", 1, 50)
        ];
        $invoiceItems = new InvoiceItems($items);

        $this->assertInstanceOf(InvoiceItems::class, $invoiceItems);
    }

    /**
     * @test
     */
    public function itCanGetCountOfItems()
    {
        $items = [
            new InvoiceItem("Polozka faktury", 2, 100),
            new InvoiceItem("Dalsi polozka faktury", 1, 50)
        ];
        $invoiceItems = new InvoiceItems($items);

        $this->assertEquals(2, $invoiceItems->count());
    }

    /**
     * @test
     */
    public function itCanAddItem()
    {
        $invoiceItems = new InvoiceItems();

        $this->assertEquals(0, $invoiceItems->count());

        $invoiceItems = $invoiceItems->add(new InvoiceItem("Polozka", 1, 300));
        $this->assertEquals(1, $invoiceItems->count());

        $invoiceItems = $invoiceItems->add(new InvoiceItem("Polozka 2", 1, 300));
        $this->assertEquals(2, $invoiceItems->count());
    }

    /**
     * @test
     */
    public function itCanGetTotalAmount()
    {
        $invoiceItems = new InvoiceItems();

        $this->assertEquals(0, $invoiceItems->count());

        $invoiceItems = $invoiceItems->add(new InvoiceItem("Polozka", 1, 300));
        $this->assertEquals(1, $invoiceItems->count());

        $invoiceItems = $invoiceItems->add(new InvoiceItem("Polozka 2", 3, 300));
        $this->assertEquals(2, $invoiceItems->count());

        $this->assertEquals(
            1200,
            $invoiceItems->totalAmount()->getAmount()
        );
    }
}
