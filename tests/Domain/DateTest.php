<?php

declare(strict_types=1);

namespace DDDWorkshop\Domain;

use DDDWorkshop\Domain\ValueObjects\Date;
use PHPUnit\Framework\TestCase;

class DateTest extends TestCase
{
    /**
     * @test
     */
    public function itCreateItselfGivenValidDateUsingConstructor()
    {
        $date = new Date(2018, 11, 23);

        $this->assertInstanceOf(Date::class, $date);

        $this->assertEquals(23, $date->getDay());
        $this->assertEquals(11, $date->getMonth());
        $this->assertEquals(2018, $date->getYear());
    }

    /**
     * @test
     */
    public function itCreateItselfFromCzechFormat()
    {
        $date = Date::createFromCzechString('23.11.2018');

        $this->assertInstanceOf(Date::class, $date);

        $this->assertEquals(23, $date->getDay());
        $this->assertEquals(11, $date->getMonth());
        $this->assertEquals(2018, $date->getYear());
    }
}
