<?php

declare(strict_types=1);

namespace DDDWorkshop\Domain\Entities;

use DDDWorkshop\Domain\Interfaces\RegistrNespolehlivychPlatcuInterface;
use DDDWorkshop\Domain\Interfaces\SeriesInterface;
use DDDWorkshop\Domain\ValueObjects\Buyer;
use DDDWorkshop\Domain\ValueObjects\DateOfIssue;
use DDDWorkshop\Domain\ValueObjects\DateOfPayment;
use DDDWorkshop\Domain\ValueObjects\Items;
use DDDWorkshop\Domain\ValueObjects\OrderNumber;
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
     * @var Items
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
     * @var OrderNumber
     */
    private $number;

    /**
     * @param Seller $seller
     * @param Buyer $buyer
     * @param PaymentInformation $paymentInformation
     * @param Items $invoiceItems
     * @param DateOfIssue $dateOfIssue
     * @param DateOfPayment $dateOfPayment
     * @param Paid $paid
     * @param RegistrNespolehlivychPlatcuInterface $registrNespolehlivychPlatcu
     * @param SeriesInterface $series
     * @throws \DDDWorkshop\Domain\Exceptions\DateOfPaymentIsBeforeDateOfIssue
     * @throws \DDDWorkshop\Domain\Exceptions\IcoIsOnRegistrNespolehlivychPlatcu
     */
    public function __construct(
        Seller $seller,
        Buyer $buyer,
        PaymentInformation $paymentInformation,
        Items $invoiceItems,
        DateOfIssue $dateOfIssue,
        DateOfPayment $dateOfPayment,
        Paid $paid,
        RegistrNespolehlivychPlatcuInterface $registrNespolehlivychPlatcu,
        SeriesInterface $series
    ) {
        $registrNespolehlivychPlatcu->check($seller->getIco());

        $number = $series->getNextNumber();

        $dateOfIssue->checkIsBefore($dateOfPayment);

        $this->seller = $seller;
        $this->buyer = $buyer;
        $this->paymentInformation = $paymentInformation;
        $this->invoiceItems = $invoiceItems;
        $this->dateOfIssue = $dateOfIssue;
        $this->dateOfPayment = $dateOfPayment;
        $this->paid = $paid;
        $this->number = $number;
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
     * @return OrderNumber
     */
    public function getNumber(): OrderNumber
    {
        return $this->number;
    }

    public function getTotalAmount(): TotalAmount
    {
        return $this->getInvoiceItems()->totalAmount();
    }

    /**
     * @return Items
     */
    public function getInvoiceItems(): Items
    {
        return $this->invoiceItems;
    }
}
