<?php

declare(strict_types=1);

namespace DDDWorkshop\Fixtures;

use DDDWorkshop\Domain\Interfaces\RegistrNespolehlivychPlatcuInterface;
use DDDWorkshop\Domain\ValueObjects\ICO;

class PassingRegistrNespolehlivychPlatcu implements RegistrNespolehlivychPlatcuInterface
{
    public function isPresentByIco(ICO $ico): bool
    {
        return false;
    }

    public function check(ICO $ICO): void
    {

    }


}
