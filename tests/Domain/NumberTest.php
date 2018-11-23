<?php

declare(strict_types=1);

namespace DDDWorkshop\Domain;

use DDDWorkshop\Domain\ValueObjects\Number;
use PHPUnit\Framework\TestCase;

class NumberTest extends TestCase
{
    /**
     * @test
     */
    public function itCanCreateItself()
    {
        $number = new Number("V/2018001");

        $this->assertInstanceOf(Number::class, $number);
        $this->assertEquals("V/2018001", $number->getNumber());
    }
}
