<?php

declare(strict_types=1);

namespace DDDWorkshop\Domain;

use DDDWorkshop\Domain\ValueObjects\Buyer;
use DDDWorkshop\Domain\ValueObjects\ICO;
use DDDWorkshop\Domain\ValueObjects\NullICO;
use PHPUnit\Framework\TestCase;

class BuyerTest extends TestCase
{
    /**
     * @test
     */
    public function itCanCreateItselfWhenGivenValidData()
    {
        $buyer = new Buyer(
            "Pepa Voprsalek",
            "Ulicni 1, Mesto, 000 00",
            new ICO("25596641")
        );

        $this->assertInstanceOf(Buyer::class, $buyer);
    }

    /**
     * @test
     */
    public function itCanCreateItselfWithNullIco()
    {
        $buyer = new Buyer(
            "Pepa Koncak",
            "Koncakova strase, Konecna stanice, 123 45",
            new NullICO('')
        );
        $this->assertInstanceOf(Buyer::class, $buyer);
        $this->assertEquals($buyer->getIco()->getIco(), '');
    }
}
