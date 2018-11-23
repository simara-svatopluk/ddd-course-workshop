<?php

declare(strict_types=1);

namespace DDDWorkshop\Domain;

use DDDWorkshop\Domain\ValueObjects\ICO;
use DDDWorkshop\Domain\ValueObjects\Seller;
use PHPUnit\Framework\TestCase;

class SellerTest extends TestCase
{
    /**
     * @test
     */
    public function itCanCreateItselfWhenGivenValidData()
    {
        $seller = new Seller("Kupujici Honza", "Ztracena 12, Viden-Sever, 60200", new ICO("25596641"));

        $this->assertInstanceOf(Seller::class, $seller);
    }
}
