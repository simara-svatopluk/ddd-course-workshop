<?php

declare(strict_types=1);

namespace DDDWorkshop\Domain\Entities;

use Carbon\Carbon;
use DDDWorkshop\Domain\Exceptions\DateOfPaymentIsBeforeDateOfIssue;
use DDDWorkshop\Domain\Exceptions\IcoIsOnRegistrNespolehlivychPlatcu;
use DDDWorkshop\Domain\Exceptions\SellerIsOnRegistrNespolehlivychPlatcu;
use DDDWorkshop\Domain\Services\RegistrNespolehlivychPlatcu;
use DDDWorkshop\Domain\Services\Series;
use DDDWorkshop\Domain\ValueObjects\BankAccountNumber;
use DDDWorkshop\Domain\ValueObjects\Buyer;
use DDDWorkshop\Domain\ValueObjects\DateOfIssue;
use DDDWorkshop\Domain\ValueObjects\DateOfPayment;
use DDDWorkshop\Domain\ValueObjects\ICO;
use DDDWorkshop\Domain\ValueObjects\Item;
use DDDWorkshop\Domain\ValueObjects\Items;
use DDDWorkshop\Domain\ValueObjects\Paid;
use DDDWorkshop\Domain\ValueObjects\PaymentInformation;
use DDDWorkshop\Domain\ValueObjects\Seller;
use DDDWorkshop\Domain\ValueObjects\VariableSymbol;
use DDDWorkshop\Fixtures\RegistrNespolehlivychPlatcuThatAlwaysReturnsTrue;
use PHPUnit\Framework\TestCase;

class IssuedInvoiceTest extends TestCase
{
    /**
     * @test
     */
    public function canBeCreatedByProperInformation(): void
    {
        $issuedInvoice = new IssuedInvoice(
            $this->createCorrectSeller(),
            $this->createCorrectBuyer(),
            $this->createCorrectPaymentInformation(),
            new Items([
                new Item('Polozka 1', 1, 100)
            ]),
            new DateOfIssue(Carbon::createFromDate(2018, 11, 23)),
            new DateOfPayment(Carbon::createFromDate(2018, 11, 24)),
            new Paid(false),
            new RegistrNespolehlivychPlatcu(),
            new Series()
        );

        $this->assertInstanceOf(IssuedInvoice::class, $issuedInvoice);
    }

    /**
     * @test
     */
    public function itCanGetTotalAmount(): void
    {
        $issuedInvoice = new IssuedInvoice(
            $this->createCorrectSeller(),
            $this->createCorrectBuyer(),
            $this->createCorrectPaymentInformation(),
            new Items([
                new Item("Polozka 1", 1, 200),
                new Item("Polozka 2", 3, 500)
            ]),
            new DateOfIssue(Carbon::createFromDate(2018, 11, 23)),
            new DateOfPayment(Carbon::createFromDate(2018, 11, 24)),
            new Paid(false),
            new RegistrNespolehlivychPlatcu(),
            new Series()
        );

        $this->assertEquals(1700, $issuedInvoice->getTotalAmount()->toFloat());
    }

    /**
     * @test
     */
    public function itThrowsExceptionWhenBuyerIsOnRegistrNespolehlivychPlatcu(): void
    {
        $this->expectException(IcoIsOnRegistrNespolehlivychPlatcu::class);

        new IssuedInvoice(
            $this->createCorrectSeller(),
            $this->createCorrectBuyer(),
            $this->createCorrectPaymentInformation(),
            new Items([
                new Item("Polozka 1", 1, 200),
                new Item("Polozka 2", 3, 500)
            ]),
            new DateOfIssue(Carbon::createFromDate(2018, 11, 23)),
            new DateOfPayment(Carbon::createFromDate(2018, 11, 24)),
            new Paid(false),
            new RegistrNespolehlivychPlatcuThatAlwaysReturnsTrue(),
            new Series()
        );
    }

    /**
     * @test
     */
    public function itThrowsExceptionWhenDateOfPaymentIsBeforeDateOfIssue(): void
    {
        $this->expectException(DateOfPaymentIsBeforeDateOfIssue::class);

        new IssuedInvoice(
            $this->createCorrectSeller(),
            $this->createCorrectBuyer(),
            $this->createCorrectPaymentInformation(),
            new Items([
                new Item("Polozka 1", 1, 200),
                new Item("Polozka 2", 3, 500)
            ]),
            new DateOfIssue(Carbon::createFromDate(2018, 11, 24)),
            new DateOfPayment(Carbon::createFromDate(2018, 11, 22)),
            new Paid(false),
            new RegistrNespolehlivychPlatcu(),
            new Series()
        );
    }

    /**
     * @return Seller
     */
    protected function createCorrectSeller(): Seller
    {
        return new Seller(
            "Franta Prodavajici",
            "Adresa nekde",
            new ICO("25596641")
        );
    }

    /**
     * @return Buyer
     */
    protected function createCorrectBuyer(): Buyer
    {
        return new Buyer(
            "Jozko Kukuricudus",
            "Henten Dinamit 23, Kosice",
            new ICO("25596641")
        );
    }

    /**
     * @return PaymentInformation
     */
    protected function createCorrectPaymentInformation(): PaymentInformation
    {
        return new PaymentInformation(
            new BankAccountNumber("000111/22"),
            new VariableSymbol("")
        );
    }
}
