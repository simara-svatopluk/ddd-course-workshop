<?php

declare(strict_types=1);

namespace DDDWorkshop\Domain\Interfaces;

use DDDWorkshop\Domain\ValueObjects\ICO;

interface RegistrNespolehlivychPlatcuInterface
{
    /**
     * Checks the Registr nespolehlivych platcu by ICO
     *
     * @param ICO $ico
     * @return bool - true if subject was found, false if not.
     */
    public function isPresentByIco(ICO $ico): bool;
}
