<?php

declare(strict_types=1);

namespace DDDWorkshop\Domain;

use DDDWorkshop\Infrastructure\StaticSeries;
use PHPUnit\Framework\TestCase;

final class IssuedInvoiceTest extends TestCase
{
    public function testAddItemToEmptyInvoice()
    {
        $invoice = new IssuedInvoice($this->createStaticSeries(), []);

        $invoice->addItem(new Item('', 1.0));

        $expected = [
            new Item('', 1.0),
        ];
        $this->assertEquals($expected, $invoice->getItems());
    }

    public function testAddItem()
    {
        $invoice = new IssuedInvoice(
            $this->createStaticSeries(),
            [new Item('table', 1000.0)]
        );

        $invoice->addItem(new Item('', 1.0));

        $expected = [
            new Item('table', 1000.0),
            new Item('', 1.0),
        ];
        $this->assertEquals($expected, $invoice->getItems());
    }

    public function testRemoveItemEndsWithoutThisItem(): void
    {
        $invoice = new IssuedInvoice(
            $this->createStaticSeries(),
            [
                new Item('table', 1000.0),
                new Item('spoon', 10.0),
            ]
        );

        $invoice->removeItem(new Item('table', 1000.0));

        $expected = [
            new Item('spoon', 10.0),
        ];
        $this->assertEquals($expected, $invoice->getItems());
    }

    public function testRemoveNonExistingItemThrowsException(): void
    {
        $this->expectException(Exception::class);

        $invoice = new IssuedInvoice(
            $this->createStaticSeries(),
            [
                new Item('table', 1000.0),
                new Item('spoon', 10.0),
            ]
        );

        $invoice->removeItem(new Item('fork', 50.0));
    }

    public function testIssuedInvoiceUsesSeriesAndTheRightNumber(): void
    {
        $series = new StaticSeries(new Number('2018', '1'));
        $invoice = new IssuedInvoice($series, []);

        $expected = new Number('2018', '1');
        $this->assertEquals($expected, $invoice->getNumber());
    }

    private function createStaticSeries(): StaticSeries
    {
        return new StaticSeries(new Number('', '1'));
    }
}
