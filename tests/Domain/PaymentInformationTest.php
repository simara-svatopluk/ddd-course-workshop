<?php

declare(strict_types=1);

namespace DDDWorkshop\Domain;

use DDDWorkshop\Domain\ValueObjects\BankAccountNumber;
use DDDWorkshop\Domain\ValueObjects\PaymentInformation;
use DDDWorkshop\Domain\ValueObjects\VariableSymbol;
use PHPUnit\Framework\TestCase;

class PaymentInformationTest extends TestCase
{
    /**
     * @test
     */
    public function itCanCreateItselfGivenValidData():void
    {
        $paymentInformation = new PaymentInformation(
            new BankAccountNumber('1313318022/3030'),
            new VariableSymbol('20180001')
        );

        $this->assertInstanceOf(PaymentInformation::class, $paymentInformation);
    }
}
