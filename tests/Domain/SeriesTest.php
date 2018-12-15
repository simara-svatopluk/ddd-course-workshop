<?php

declare(strict_types=1);

namespace DDDWorkshop\Domain;

use PHPUnit\Framework\TestCase;

abstract class SeriesTest extends TestCase
{
    public function testFirstNumber(): void
    {
        $series = $this->getSeries();

        $actual = $series->next();

        $expected = new Number('2018', '1');
        $this->assertEquals($expected, $actual);
    }

    public function testNextTwoNumbers(): void
    {
        $series = $this->getSeries();

        $actual = [
            $series->next(),
            $series->next(),
        ];

        $expected = [
            new Number('2018', '1'),
            new Number('2018', '2'),
        ];
        $this->assertEquals($expected, $actual);
    }

    abstract protected function getSeries(): Series;
}
