<?php

declare(strict_types=1);

namespace DDDWorkshop\Domain\ValueObjects;


class NullICO extends ICO
{
    protected function validate(string $ico): string
    {
        //skip validation
        return $ico;
    }
}