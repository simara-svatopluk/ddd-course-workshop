<?php

declare(strict_types=1);

namespace DDDWorkshop\Infrastructure;

use DDDWorkshop\Domain\IssuedInvoices;
use DDDWorkshop\Domain\IssuedInvoicesTest;

final class MemoryIssuedInvoiceTest extends IssuedInvoicesTest
{
    protected function createIssuedInvoices(): IssuedInvoices
    {
        return new MemoryIssuedInvoices();
    }

    protected function flush()
    {
        // do nothing, we run in memory
    }
}
