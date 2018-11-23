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
     * @return bool - true if subject was not found, false if it was.
     */
    public function checkByIco(ICO $ico): bool;
}
