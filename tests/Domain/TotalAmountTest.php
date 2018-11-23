<?php

declare(strict_types=1);

namespace DDDWorkshop\Domain;

use DDDWorkshop\Domain\ValueObjects\TotalAmount;
use PHPUnit\Framework\TestCase;

class TotalAmountTest extends TestCase
{
    public function testEmptyIsEqualToZero(): void
    {
        $totalAmount = new TotalAmount();
        $this->assertSame(0.0, $totalAmount->toFloat());
    }
}
