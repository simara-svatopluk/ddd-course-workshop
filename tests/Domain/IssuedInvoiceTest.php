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

        $invoice->addItem(new Item('', new Crown(100)));

        $expected = [
            new Item('', new Crown(100)),
        ];
        $this->assertEquals($expected, $invoice->getItems());
    }

    public function testAddItem()
    {
        $invoice = new IssuedInvoice(
            $this->createStaticSeries(),
            [new Item('table', new Crown(100000))]
        );

        $invoice->addItem(new Item('', new Crown(100)));

        $expected = [
            new Item('table', new Crown(100000)),
            new Item('', new Crown(100)),
        ];
        $this->assertEquals($expected, $invoice->getItems());
    }

    public function testRemoveItemEndsWithoutThisItem(): void
    {
        $invoice = new IssuedInvoice(
            $this->createStaticSeries(),
            [
                new Item('table', new Crown(100000)),
                new Item('spoon', new Crown(1000)),
            ]
        );

        $invoice->removeItem(new Item('table', new Crown(100000)));

        $expected = [
            new Item('spoon', new Crown(1000)),
        ];
        $this->assertEquals($expected, $invoice->getItems());
    }

    public function testRemoveNonExistingItemThrowsException(): void
    {
        $this->expectException(Exception::class);

        $invoice = new IssuedInvoice(
            $this->createStaticSeries(),
            [
                new Item('table', new Crown(100000)),
                new Item('spoon', new Crown(10000)),
            ]
        );

        $invoice->removeItem(new Item('fork', new Crown(5000)));
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
