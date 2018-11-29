<?php

declare(strict_types=1);

namespace DDDWorkshop\Domain\ValueObjects;

class PaymentInformation
{
    /**
     * @var BankAccountNumber
     */
    private $bankAccountNumber;
    /**
     * @var VariableSymbol
     */
    private $variableSymbol;

    /**
     * @param BankAccountNumber $bankAccountNumber
     * @param VariableSymbol $variableSymbol
     */
    public function __construct(BankAccountNumber $bankAccountNumber, VariableSymbol $variableSymbol)
    {
        $this->bankAccountNumber = $bankAccountNumber;
        $this->variableSymbol = $variableSymbol;
    }

    /**
     * @return BankAccountNumber
     */
    public function getBankAccountNumber(): BankAccountNumber
    {
        return $this->bankAccountNumber;
    }

    /**
     * @return VariableSymbol
     */
    public function getVariableSymbol(): VariableSymbol
    {
        return $this->variableSymbol;
    }
}
