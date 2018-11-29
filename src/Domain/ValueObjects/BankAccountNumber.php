<?php

declare(strict_types=1);

namespace DDDWorkshop\Domain\ValueObjects;


class BankAccountNumber
{
    /**
     * @var string
     */
    private $number;

    /**
     * @param string $number
     */
    public function __construct(string $number)
    {
        $this->validate($number);

        $this->number = $number;
    }

    /**
     * TODO: Here could be validation, but we need to validate bank code also, which can change in time. The current list
     * of bank codes can be found on CSV on CNB site, but this is too complex to implement now
     * (mainly because i do not know, how and if i can inject dependencies into VOs)
     * @param string $number
     */
    protected function validate(string $number): void
    {

    }

    /**
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }
}