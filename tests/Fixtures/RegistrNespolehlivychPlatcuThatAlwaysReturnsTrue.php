<?php

declare(strict_types=1);

namespace DDDWorkshop\Fixtures;

use DDDWorkshop\Domain\Interfaces\RegistrNespolehlivychPlatcuInterface;
use DDDWorkshop\Domain\ValueObjects\ICO;

class RegistrNespolehlivychPlatcuThatAlwaysReturnsTrue implements RegistrNespolehlivychPlatcuInterface
{
    public function isPresentByIco(ICO $ico): bool
    {
        return true;
    }
}
