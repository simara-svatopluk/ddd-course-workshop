<?php

declare(strict_types=1);

namespace DDDWorkshop\Domain;

use DDDWorkshop\Domain\ValueObjects\VariableSymbol;
use PHPUnit\Framework\TestCase;

class VariableSymbolTest extends TestCase
{
    /**
     * @test
     */
    public function canBeCreatedGivenValidData(): void
    {
        $variableSymbol = new VariableSymbol('20180001');

        $this->assertInstanceOf(VariableSymbol::class, $variableSymbol);
        $this->assertEquals('20180001', $variableSymbol->getVariableSymbol());
    }
}