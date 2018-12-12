<?php declare(strict_types=1);
namespace DDDWorkshop\Domain\Interfaces;

interface IEquatable
{
    /**
     * @param IEquatable $other
     * @return bool
     */
    public function equals(IEquatable $other): bool;
}
