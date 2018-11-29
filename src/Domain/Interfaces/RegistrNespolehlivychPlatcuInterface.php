<?php

declare(strict_types=1);

namespace DDDWorkshop\Domain\Interfaces;

use DDDWorkshop\Domain\Exceptions\IcoIsOnRegistrNespolehlivychPlatcu;
use DDDWorkshop\Domain\ValueObjects\ICO;

interface RegistrNespolehlivychPlatcuInterface
{
    /**
     * Checks if this ICO is on the Registr nespolehlivych platcu
     *
     * @param ICO $ico
     * @return bool - true if subject was found, false if not.
     */
    public function isPresentByIco(ICO $ico): bool;

    /**
     * Checks the Registr nespolehlivych platcu by ICO, throws exception if found
     *
     * @param ICO $ICO
     * @throws IcoIsOnRegistrNespolehlivychPlatcu
     */
    public function check(ICO $ICO): void;
}
