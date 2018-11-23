<?php

declare(strict_types=1);

namespace DDDWorkshop\Domain\Entities;

use DDDWorkshop\Domain\Interfaces\RegistrNespolehlivychPlatcuInterface;
use DDDWorkshop\Domain\Interfaces\SeriesInterface;
use DDDWorkshop\Domain\ValueObjects\Buyer;
use DDDWorkshop\Domain\ValueObjects\DateOfIssue;
use DDDWorkshop\Domain\ValueObjects\DateOfPayment;
use DDDWorkshop\Domain\ValueObjects\InvoiceItems;
use DDDWorkshop\Domain\ValueObjects\Number;
use DDDWorkshop\Domain\ValueObjects\Paid;
use DDDWorkshop\Domain\ValueObjects\PaymentInformation;
use DDDWorkshop\Domain\ValueObjects\Seller;
use DDDWorkshop\Domain\ValueObjects\TotalAmount;

class IssuedInvoice
{
    /**
     * @var Seller
     */
    private $seller;
    /**
     * @var Buyer
     */
    private $buyer;
    /**
     * @var PaymentInformation
     */
    private $paymentInformation;
    /**
     * @var InvoiceItems
     */
    private $invoiceItems;
    /**
     * @var DateOfIssue
     */
    private $dateOfIssue;
    /**
     * @var DateOfPayment
     */
    private $dateOfPayment;
    /**
     * @var Paid
     */
    private $paid;
    /**
     * @var Number
     */
    private $number;
    /**
     * @var RegistrNespolehlivychPlatcuInterface
     */
    private $registrNespolehlivychPlatcu;
    /**
     * @var SeriesInterface
     */
    private $series;

    /**
     * IssuedInvoice constructor.
     * @param Seller $seller
     * @param Buyer $buyer
     * @param PaymentInformation $paymentInformation
     * @param InvoiceItems $invoiceItems
     * @param DateOfIssue $dateOfIssue
     * @param DateOfPayment $dateOfPayment
     * @param Paid $paid
     * @param RegistrNespolehlivychPlatcuInterface $registrNespolehlivychPlatcu
     * @param SeriesInterface $series
     */
    public function __construct(
        Seller $seller,
        Buyer $buyer,
        PaymentInformation $paymentInformation,
        InvoiceItems $invoiceItems,
        DateOfIssue $dateOfIssue,
        DateOfPayment $dateOfPayment,
        Paid $paid,
        RegistrNespolehlivychPlatcuInterface $registrNespolehlivychPlatcu,
        SeriesInterface $series
    ) {
        //check Registr Nespolehlivych Platcu
        if ($registrNespolehlivychPlatcu->checkByIco($seller->getIco())) {
            // TODO: throw exception
        }
        //get next number in series
        $number = $series->getNextNumber();
        //check that date of issue is before date of payment
        if (!$dateOfIssue->getDate()->earlierThan($dateOfPayment->getDate())) {
            //todo: throw exception
        }

        $this->seller = $seller;
        $this->buyer = $buyer;
        $this->paymentInformation = $paymentInformation;
        $this->invoiceItems = $invoiceItems;
        $this->dateOfIssue = $dateOfIssue;
        $this->dateOfPayment = $dateOfPayment;
        $this->paid = $paid;
        $this->number = $number;

        $this->registrNespolehlivychPlatcu = $registrNespolehlivychPlatcu;
        $this->series = $series;
    }

    /**
     * @return Seller
     */
    public function getSeller(): Seller
    {
        return $this->seller;
    }

    /**
     * @return Buyer
     */
    public function getBuyer(): Buyer
    {
        return $this->buyer;
    }

    /**
     * @return PaymentInformation
     */
    public function getPaymentInformation(): PaymentInformation
    {
        return $this->paymentInformation;
    }

    /**
     * @return InvoiceItems
     */
    public function getInvoiceItems(): InvoiceItems
    {
        return $this->invoiceItems;
    }

    /**
     * @return DateOfIssue
     */
    public function getDateOfIssue(): DateOfIssue
    {
        return $this->dateOfIssue;
    }

    /**
     * @return DateOfPayment
     */
    public function getDateOfPayment(): DateOfPayment
    {
        return $this->dateOfPayment;
    }

    /**
     * @return Paid
     */
    public function getPaid(): Paid
    {
        return $this->paid;
    }

    /**
     * @return Number
     */
    public function getNumber(): Number
    {
        return $this->number;
    }

    public function getTotalAmount(): TotalAmount
    {
        return $this->getInvoiceItems()->totalAmount();
    }
}
