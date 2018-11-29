<?php

declare(strict_types=1);

namespace DDDWorkshop\Domain;


use DDDWorkshop\Domain\ValueObjects\BankAccountNumber;
use PHPUnit\Framework\TestCase;

class BankAccountNumberTest extends TestCase
{
    /**
     * @test
     */
    public function canBeCreatedByProperInformation(): void
    {
        $bankAccountNumber = new BankAccountNumber('1313318022/3030');

        $this->assertInstanceOf(BankAccountNumber::class, $bankAccountNumber);
        $this->assertEquals('1313318022/3030', $bankAccountNumber->getNumber());
    }
}