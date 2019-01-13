<?php

declare(strict_types=1);

namespace DDDWorkshop\Domain;

use DDDWorkshop\Infrastructure\StaticSeries;
use PHPUnit\Framework\TestCase;

abstract class IssuedInvoicesTest extends TestCase
{
    /**
     * @var IssuedInvoices
     */
    private $issuedInvoices;

    abstract protected function createIssuedInvoices(): IssuedInvoices;

    abstract protected function flush();

    protected function setUp()
    {
        $this->issuedInvoices = $this->createIssuedInvoices();
    }

    public function testGetNotExistingCauseException()
    {
        $this->expectException(Exception::class);
        $this->issuedInvoices->get(new Number('', '1'));
    }

    public function testRemoveNotExistingCauseException()
    {
        $this->expectException(Exception::class);
        $this->issuedInvoices->remove(new Number('', '1'));
    }

    public function testAddAndGet(): void
    {
        $number = new Number('', '1');
        $invoice = $this->createIssuedInvoice($number);
        $this->issuedInvoices->add($invoice);
        $this->flush();

        $actual = $this->issuedInvoices->get($number);
        $this->assertIssuedInvoice($invoice, $actual);
    }

    public function testAddedAndThenChangedIsFlushed()
    {
        $number = new Number('', '1');

        $expected = $this->createIssuedInvoice($number);
        $this->issuedInvoices->add($expected);
        $expected->addItem(new Item('spoon', new Crown(1000)));
        $this->flush();

        $actual = $this->issuedInvoices->get($number);
        $this->assertCount(2, $actual->getItems());
        $this->assertIssuedInvoice($expected, $actual);
    }

    public function testFlushGettedItemPersists()
    {
        $number = new Number('', '1');

        $new = $this->createIssuedInvoice($number);
        $this->issuedInvoices->add($new);
        $this->flush();

        $expected = $this->issuedInvoices->get($number);
        $expected->addItem(new Item('spoon', new Crown(1000)));
        $this->flush();

        $actual = $this->issuedInvoices->get($number);
        $this->assertCount(2, $actual->getItems());
        $this->assertIssuedInvoice($expected, $actual);
    }

    public function testFlushRemovedItemPersists()
    {
        $number = new Number('', '1');

        $new = $this->createIssuedInvoice($number);
        $this->issuedInvoices->add($new);
        $this->flush();

        $expected = $this->issuedInvoices->get($number);
        $expected->removeItem(new Item('table', new Crown(5000)));
        $this->flush();

        $actual = $this->issuedInvoices->get($number);
        $this->assertCount(0, $actual->getItems());
        $this->assertIssuedInvoice($expected, $actual);
    }

    public function testAddAndRemove()
    {
        $number = new Number('', '1');

        $issuedInvoice = $this->createIssuedInvoice($number);
        $this->issuedInvoices->add($issuedInvoice);
        $this->flush();

        $this->issuedInvoices->remove($number);
        $this->flush();

        $this->expectException(Exception::class);
        $this->issuedInvoices->remove($number);
    }

    private function assertIssuedInvoice(IssuedInvoice $expected, IssuedInvoice $issuedInvoice): void
    {
        $this->assertTrue($expected->getNumber()->equals($issuedInvoice->getNumber()));
        $this->assertEquals($expected->getItems(), $issuedInvoice->getItems());
    }

    private function createIssuedInvoice(Number $number): IssuedInvoice
    {
        $series = new StaticSeries($number);
        $items = [
            new Item('table', new Crown(5000)),
        ];
        return new IssuedInvoice($series, $items);
    }
}
