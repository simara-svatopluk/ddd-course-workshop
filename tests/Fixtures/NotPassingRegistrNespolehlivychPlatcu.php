<?php

declare(strict_types=1);

namespace DDDWorkshop\Fixtures;

use DDDWorkshop\Domain\Exceptions\IcoIsOnRegistrNespolehlivychPlatcu;
use DDDWorkshop\Domain\Interfaces\RegistrNespolehlivychPlatcuInterface;
use DDDWorkshop\Domain\ValueObjects\ICO;

class NotPassingRegistrNespolehlivychPlatcu implements RegistrNespolehlivychPlatcuInterface
{
    public function isPresentByIco(ICO $ico): bool
    {
        return true;
    }

    public function check(ICO $ICO): void
    {
        throw new IcoIsOnRegistrNespolehlivychPlatcu($ICO);
    }
}
