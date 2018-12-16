<?php

declare(strict_types=1);

namespace DDDWorkshop\Domain;

use PHPUnit\Framework\TestCase;

final class CrownTest extends TestCase
{
    /**
     * @dataProvider floatTestCases
     */
    public function testCreateFromFloat(float $crowns, Crown $expected): void
    {
        $actual = Crown::fromCrowns($crowns);
        $this->assertEquals($expected, $actual);
    }

    public function floatTestCases(): array
    {
        return [
            [1, new Crown(100)],
            [0, new Crown(0)],
            [0.5, new Crown(50)],
            [1.25, new Crown(125)],
            [5.555, new Crown(555)],
        ];
    }
}
