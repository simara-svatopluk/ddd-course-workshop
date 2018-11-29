<?php

declare(strict_types=1);

namespace DDDWorkshop\Domain\ValueObjects;


use InvalidArgumentException;
use function strlen;

class VariableSymbol
{

    /**
     * @var string
     */
    private $variableSymbol;

    public function __construct(string $variableSymbol)
    {
        $this->validate($variableSymbol);

        $this->variableSymbol = $variableSymbol;
    }

    private function validate(string $variableSymbol): void
    {
        if (strlen($variableSymbol) > 10) {
            throw new InvalidArgumentException('Variable symbol must be at maximum 10 characters long.');
        }
    }

    /**
     * @return string
     */
    public function getVariableSymbol(): string
    {
        return $this->variableSymbol;
    }
}