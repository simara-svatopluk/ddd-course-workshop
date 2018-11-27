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

    /**
     * @test
     */
    public function itThrowsExceptionWhenCreatingFromCzechFormatWithWrongFormat()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid date given');

        Date::createFromCzechString('01.11.2018');

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid date given');

        Date::createFromCzechString('1.14.2018');
    }

    /**
     * @test
     */
    public function itCanCorrectlyTellIfItIsEarlierThanGivenDate()
    {
        $date = new Date(2016, 9, 24);
        $givenDate = new Date(2018, 11, 24);

        $this->assertTrue($date->earlierThan($givenDate));
    }

    /**
     * @test
     */
    public function itCanCorrectlyTellIfItIsLaterThanGivenDate()
    {
        $date = new Date(2020, 12, 24);
        $givenDate = new Date(2018, 11, 24);

        $this->assertTrue($date->laterThan($givenDate));
    }

    /**
     * @test
     */
    public function itCanCorrectlyTellIfItIsNotLaterThanGivenDate()
    {
        $date = new Date(2016, 12, 24);
        $givenDate = new Date(2018, 11, 24);

        $this->assertFalse($date->laterThan($givenDate));
    }

    /**
     * @test
     */
    public function itCanCorrectlyTellIfItIsNotEarlierThanGivenDate()
    {
        $date = new Date(2020, 12, 24);
        $givenDate = new Date(2018, 11, 24);

        $this->assertFalse($date->earlierThan($givenDate));
    }

    /**
     * @test
     */
    public function itCanTellIfItEqualsToGivenDate()
    {
        $date = new Date(2020, 12, 24);
        $givenDate = new Date(2020, 12, 24);

        $this->assertTrue($date->equalsTo($givenDate));
    }

    /**
     * @test
     */
    public function itCanTellIfItNotEqualsToGivenDate()
    {
        $date = new Date(2020, 12, 24);
        $givenDate = new Date(2021, 12, 24);

        $this->assertFalse($date->equalsTo($givenDate));
    }
}
