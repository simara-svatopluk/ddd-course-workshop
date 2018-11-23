<?php

declare(strict_types=1);

namespace DDDWorkshop\Domain\Services;

use DDDWorkshop\Domain\Interfaces\RegistrNespolehlivychPlatcuInterface;
use DDDWorkshop\Domain\ValueObjects\ICO;

class RegistrNespolehlivychPlatcu implements RegistrNespolehlivychPlatcuInterface
{
    public function checkByIco(ICO $ico): bool
    {
        return true;
    }
}
