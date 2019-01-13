<?php

declare(strict_types=1);

namespace DDDWorkshop\Domain;

interface IssuedInvoices
{
    public function add(IssuedInvoice $issuedInvoice): void;

    public function get(Number $number): IssuedInvoice;

    public function remove(Number $number): void;
}
