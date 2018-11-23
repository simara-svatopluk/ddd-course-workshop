<?php

declare(strict_types=1);

namespace DDDWorkshop\Domain;

use DDDWorkshop\Domain\ValueObjects\PaymentInformation;
use PHPUnit\Framework\TestCase;

class PaymentInformationTest extends TestCase
{
    /**
     * @test
     */
    public function itCanCreateItselfGivenValidData()
    {
        $paymentInformation = new PaymentInformation("Bankovní převod");

        $this->assertInstanceOf(PaymentInformation::class, $paymentInformation);
    }
}
