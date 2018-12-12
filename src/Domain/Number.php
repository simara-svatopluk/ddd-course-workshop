<?php declare(strict_types=1);
namespace DDDWorkshop\Domain;

use DDDWorkshop\Domain\Interfaces\IEquatable;
use DDDWorkshop\Domain\Interfaces\IValueObject;

class Number implements IValueObject
{
    /** @var string */
    private $number;


    /**
     * @param string $number
     */
    public function __construct(string $number)
    {
        $this->number = $number;
    }

    /**
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * @param IEquatable $other
     * @return bool
     */
    public function equals(IEquatable $other): bool
    {
        return ($other instanceof self
            && $other->number === $this->number);
    }
}
