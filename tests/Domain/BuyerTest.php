<?php

declare(strict_types=1);

namespace DDDWorkshop\Domain;

use DDDWorkshop\Domain\ValueObjects\Buyer;
use DDDWorkshop\Domain\ValueObjects\ICO;
use PHPUnit\Framework\TestCase;

class BuyerTest extends TestCase
{
    /**
     * @test
     */
    public function itCanCreateItselfWhenGivenInvalidData()
    {
        $buyer = new Buyer(
            "Pepa Voprsalek",
            "Ulicni 1, Mesto, 000 00",
            new ICO("25596641")
        );

        $this->assertInstanceOf(Buyer::class, $buyer);
    }
}
