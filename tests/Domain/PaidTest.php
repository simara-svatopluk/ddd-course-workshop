<?php

declare(strict_types=1);

namespace DDDWorkshop\Domain;

use DDDWorkshop\Domain\ValueObjects\Paid;
use PHPUnit\Framework\TestCase;

class PaidTest extends TestCase
{
    /**
     * @test
     */
    public function itCanCreateItselfAsTrue()
    {
        $paid = new Paid(true);

        $this->assertEquals(true, $paid->is());
    }

    /**
     * @test
     */
    public function itCanCreateItselfAsFalse()
    {
        $paid = new Paid(false);

        $this->assertEquals(false, $paid->is());
    }
}
