<?php

declare(strict_types=1);

namespace DDDWorkshop\Infrastructure;

use DDDWorkshop\Domain\Exception;
use DDDWorkshop\Domain\Number;
use DDDWorkshop\Domain\IssuedInvoice;
use DDDWorkshop\Domain\IssuedInvoices;

final class MemoryIssuedInvoices implements IssuedInvoices
{
    /**
     * @var IssuedInvoice[]
     */
    private $issuedInvoices = [];

    public function add(IssuedInvoice $issuedInvoice): void
    {
        $this->issuedInvoices[$issuedInvoice->getNumber()->toString()] = $issuedInvoice;
    }

    public function get(Number $number): IssuedInvoice
    {
        $this->check($number);
        return $this->issuedInvoices[$number->toString()];
    }

    public function remove(Number $number): void
    {
        $this->check($number);
        unset($this->issuedInvoices[$number->toString()]);
    }

    private function check(Number $number): void
    {
        if (!isset($this->issuedInvoices[$number->toString()])) {
            throw new Exception();
        }
    }
}
