<?php declare(strict_types=1);
namespace DDDWorkshop\Domain;

use DDDWorkshop\Domain\Interfaces\IEquatable;
use DDDWorkshop\Domain\Interfaces\IValueObject;

class Buyer implements IValueObject
{
    /** @var string */
    private $data;


    /**
     * @param string $data
     */
    public function __construct(string $data)
    {
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function getData(): string
    {
        return $this->data;
    }

    /**
     * @param IEquatable $other
     * @return bool
     */
    public function equals(IEquatable $other): bool
    {
        return ($other instanceof self
            && $other->data === $this->data);
    }
}
