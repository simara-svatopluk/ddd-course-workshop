<?php declare(strict_types=1);
namespace DDDWorkshop\Domain;

use Money\Money;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \DDDWorkshop\Domain\TotalAmount
 */
class TotalAmountTest extends TestCase
{
    /**
     * @covers ::toFloat
     */
    public function testToFloat(): void
    {
        $amountFloat = 5.5;
        $amount = Money::CZK((string) ($amountFloat * 100));
        $totalAmount = new TotalAmount($amount);
        self::assertSame($amountFloat, $totalAmount->toFloat());
    }

    /**
     * @covers ::getAmount
     */
    public function testGetAmount(): void
    {
        $amountFloat = 5.5;
        $amount = Money::CZK((string) ($amountFloat * 100));
        $totalAmount = new TotalAmount($amount);
        self::assertTrue($totalAmount->getAmount()->equals($amount));
    }

    /**
     * @covers ::equals
     */
    public function testEquals(): void
    {
        $amountFloat1 = 5.5;
        $amountFloat2 = 3.3;
        $amount1 = Money::CZK((string) ($amountFloat1 * 100));
        $amount2 = Money::CZK((string) ($amountFloat2 * 100));
        $totalAmount1 = new TotalAmount($amount1);
        $totalAmount2 = new TotalAmount($amount2);
        $totalAmount2b = new TotalAmount($amount2);
        self::assertFalse($totalAmount1->equals($totalAmount2));
        self::assertTrue($totalAmount2->equals($totalAmount2b));
    }

    /**
     * @expectedException \DDDWorkshop\Domain\Exceptions\CurrencyIsNotCzkException
     */
    public function testConstruct(): void
    {
        $amount = Money::EUR('200');
        new TotalAmount($amount);
    }
}
