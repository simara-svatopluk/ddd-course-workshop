<?php

declare(strict_types=1);

namespace DDDWorkshop\Domain\Entities;

use DDDWorkshop\Domain\Exceptions\DateOfPaymentIsBeforeDateOfIssue;
use DDDWorkshop\Domain\Exceptions\SellerIsOnRegistrNespolehlivychPlatcu;
use DDDWorkshop\Domain\Services\RegistrNespolehlivychPlatcu;
use DDDWorkshop\Domain\Services\Series;
use DDDWorkshop\Domain\ValueObjects\Buyer;
use DDDWorkshop\Domain\ValueObjects\Date;
use DDDWorkshop\Domain\ValueObjects\DateOfIssue;
use DDDWorkshop\Domain\ValueObjects\DateOfPayment;
use DDDWorkshop\Domain\ValueObjects\ICO;
use DDDWorkshop\Domain\ValueObjects\InvoiceItem;
use DDDWorkshop\Domain\ValueObjects\InvoiceItems;
use DDDWorkshop\Domain\ValueObjects\Paid;
use DDDWorkshop\Domain\ValueObjects\PaymentInformation;
use DDDWorkshop\Domain\ValueObjects\Seller;
use DDDWorkshop\Fixtures\RegistrNespolehlivychPlatcuThatAlwaysReturnsTrue;
use PHPUnit\Framework\TestCase;

class IssuedInvoiceTest extends TestCase
{
    /**
     * @test
     */
    public function itCanCreateItselfWithProvidedInformation():void
    {
        $issuedInvoice = new IssuedInvoice(
            new Seller(
                "Franta Prodavajici",
                "Adresa nekde",
                new ICO("25596641")
            ),
            new Buyer(
                "Jozko Kukuricudus",
                "Henten Dinamit 23, Kosice",
                new ICO("25596641")
            ),
            new PaymentInformation("Bankovním převodem"),
            new InvoiceItems([
                new InvoiceItem("Polozka 1", 1, 100)
            ]),
            new DateOfIssue(new Date(2018, 11, 23)),
            new DateOfPayment(new Date(2018, 11, 24)),
            new Paid(false),
            new RegistrNespolehlivychPlatcu(),
            new Series()
        );

        $this->assertInstanceOf(IssuedInvoice::class, $issuedInvoice);
    }

    /**
     * @test
     */
    public function itCanGetTotalAmount():void
    {
        /**
         * TODO: Jak dostanu posledni dve veci do tridy, pokud je budu mit v DIC kontejneru nabindovane pres interface?
         * Command? Service?
         */
        $issuedInvoice = new IssuedInvoice(
            new Seller(
                "Franta Prodavajici",
                "Adresa nekde",
                new ICO("25596641")
            ),
            new Buyer(
                "Jozko Kukuricudus",
                "Henten Dinamit 23, Kosice",
                new ICO("25596641")
            ),
            new PaymentInformation("Bankovním převodem"),
            new InvoiceItems([
                new InvoiceItem("Polozka 1", 1, 200),
                new InvoiceItem("Polozka 2", 3, 500)
            ]),
            new DateOfIssue(new Date(2018, 11, 23)),
            new DateOfPayment(new Date(2018, 11, 24)),
            new Paid(false),
            new RegistrNespolehlivychPlatcu(),
            new Series()
        );

        $this->assertEquals(1700, $issuedInvoice->getTotalAmount()->toFloat());
    }

    /**
     * @test
     */
    public function itThrowsExceptionWhenBuyerIsOnRegistrNespolehlivychPlatcu():void
    {
        $this->expectException(SellerIsOnRegistrNespolehlivychPlatcu::class);

        new IssuedInvoice(
            new Seller(
                "Franta Prodavajici",
                "Adresa nekde",
                new ICO("25596641")
            ),
            new Buyer(
                "Jozko Kukuricudus",
                "Henten Dinamit 23, Kosice",
                new ICO("25596641")
            ),
            new PaymentInformation("Bankovním převodem"),
            new InvoiceItems([
                new InvoiceItem("Polozka 1", 1, 200),
                new InvoiceItem("Polozka 2", 3, 500)
            ]),
            new DateOfIssue(new Date(2018, 11, 23)),
            new DateOfPayment(new Date(2018, 11, 24)),
            new Paid(false),
            new RegistrNespolehlivychPlatcuThatAlwaysReturnsTrue(),
            new Series()
        );
    }

    /**
     * @test
     */
    public function itThrowsExceptionWhenDateOfPaymentIsBeforeDateOfIssue():void
    {
        $this->expectException(DateOfPaymentIsBeforeDateOfIssue::class);

        new IssuedInvoice(
            new Seller(
                "Franta Prodavajici",
                "Adresa nekde",
                new ICO("25596641")
            ),
            new Buyer(
                "Jozko Kukuricudus",
                "Henten Dinamit 23, Kosice",
                new ICO("25596641")
            ),
            new PaymentInformation("Bankovním převodem"),
            new InvoiceItems([
                new InvoiceItem("Polozka 1", 1, 200),
                new InvoiceItem("Polozka 2", 3, 500)
            ]),
            new DateOfIssue(new Date(2018, 11, 24)),
            new DateOfPayment(new Date(2018, 11, 22)),
            new Paid(false),
            new RegistrNespolehlivychPlatcu(),
            new Series()
        );
    }
}
