<?php

declare(strict_types=1);

namespace DDDWorkshop\Domain;

use DDDWorkshop\Domain\ValueObjects\InvoiceItem;
use PHPUnit\Framework\TestCase;

class InvoiceItemTest extends TestCase
{
    /**
     * @test
     */
    public function itCanCreateItselfGivenValidData()
    {
        $invoiceItem = new InvoiceItem("Polozka faktury", 1, 100);

        $this->assertInstanceOf(InvoiceItem::class, $invoiceItem);
    }

    /**
     * @test
     */
    public function itCanGetTotalAmount()
    {
        $invoiceItem = new InvoiceItem("Polozka faktury", 1, 100);
        $this->assertEquals(100, $invoiceItem->getTotalAmount());
        $invoiceItem2 = new InvoiceItem("Polozka faktury", 3, 100);
        $this->assertEquals(300, $invoiceItem2->getTotalAmount());
    }
}
