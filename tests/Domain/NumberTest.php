<?php

declare(strict_types=1);

namespace DDDWorkshop\Domain;

use DDDWorkshop\Domain\ValueObjects\OrderNumber;
use PHPUnit\Framework\TestCase;

class NumberTest extends TestCase
{
    /**
     * @test
     */
    public function itCanCreateItself():void
    {
        $number = new OrderNumber("V/2018001");

        $this->assertInstanceOf(OrderNumber::class, $number);
        $this->assertEquals("V/2018001", $number->getNumber());
    }
}
