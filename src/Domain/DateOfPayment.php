<?php declare(strict_types=1);
namespace DDDWorkshop\Domain;

use DateTimeImmutable;
use DDDWorkshop\Domain\Interfaces\IEquatable;
use DDDWorkshop\Domain\Interfaces\IValueObject;

class DateOfPayment implements IValueObject
{
    /** @var DateTimeImmutable */
    private $date;

    /**
     * @param DateTimeImmutable $date
     */
    public function __construct(DateTimeImmutable $date)
    {
        $this->date = $date->setTime(0, 0, 0, 0);
    }

    /**
     * @return DateTimeImmutable
     */
    public function getDate(): DateTimeImmutable
    {
        return $this->date;
    }

    /**
     * @param IEquatable $other
     * @return bool
     */
    public function equals(IEquatable $other): bool
    {
        return ($other instanceof self
            && $other->date->getTimestamp() === $this->date->getTimestamp());
    }
}
