<?php declare(strict_types=1);
namespace DDDWorkshop\Domain;

interface RegistrNespolehlivychPlatcu
{
    /**
     * @param Buyer $buyer
     * @return bool
     */
    public function check(Buyer $buyer): bool;
}
