<?php

declare(strict_types=1);

namespace DDDWorkshop\Domain;

use DDDWorkshop\Domain\ValueObjects\Item;
use PHPUnit\Framework\TestCase;

class ItemTest extends TestCase
{
    /**
     * @test
     */
    public function itCanCreateItselfGivenValidData():void
    {
        $invoiceItem = new Item("Polozka faktury", 1, 100);

        $this->assertInstanceOf(Item::class, $invoiceItem);
    }

    /**
     * @test
     */
    public function itCanGetTotalAmount():void
    {
        $invoiceItem = new Item("Polozka faktury", 1, 100);
        $this->assertEquals(100, $invoiceItem->getTotalAmount());
        $invoiceItem2 = new Item("Polozka faktury", 3, 100);
        $this->assertEquals(300, $invoiceItem2->getTotalAmount());
    }
}
