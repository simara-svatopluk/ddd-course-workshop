<?php

declare(strict_types=1);

namespace DDDWorkshop\Domain;

use DDDWorkshop\Domain\ValueObjects\ICO;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class ICOTest extends TestCase
{
    /**
     * @test
     */
    public function itCanCreateItselfWhenGivenValidIco():void
    {
        $ico = new ICO("25596641");
        $this->assertInstanceOf(ICO::class, $ico);
    }

    /**
     * @test
     */
    public function itThrowsExceptionWhenGivenInvalidIco():void
    {
        $this->expectException(InvalidArgumentException::class);

        new ICO("165asd4");
    }
}
