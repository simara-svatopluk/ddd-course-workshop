<?php

declare(strict_types=1);

namespace DDDWorkshop\Domain\ValueObjects;

use DateTimeImmutable;
use InvalidArgumentException;
use function preg_match;

class Date
{
    /**
     * @var int
     */
    private $year;
    /**
     * @var int
     */
    private $month;
    /**
     * @var int
     */
    private $day;

    public function __construct(int $year, int $month, int $day)
    {
        if ($month < 1 || $month > 12) {
            throw new InvalidArgumentException("Month should be between 1 and 12, is {$month}");
        }
        if ($day < 1 || $day > 31) {
            throw new InvalidArgumentException("Day should be between 1 and 31, is {$day}");
        }

        $this->year = $year;
        $this->month = $month;
        $this->day = $day;
    }

    /**
     * Creates date from format common in Czech Republic (j.n.Y)
     *
     * Valid string: 23.11.2018, 1.11.2018, 1.1.2018
     * Invalid string: 01.11.2018 - has leading zero; 1.03.2018 - has leading zero
     *
     * @param string $dateInCzechFormat
     * @return Date
     * @throws InvalidArgumentException
     */
    public static function createFromCzechString(string $dateInCzechFormat): Date
    {
        // check format
        if (!preg_match("/^([1-9][1-9]*)\.([1-9][1-9]*)\.([0-9]{4})$/", $dateInCzechFormat)) {
            throw new InvalidArgumentException('Invalid date given');
        }
        $dt = DateTimeImmutable::createFromFormat('j.n.Y', $dateInCzechFormat);

        if (!$dt) {
            throw new InvalidArgumentException('Invalid date given');
        }

        return new static(
            (int)$dt->format('Y'),
            (int)$dt->format('m'),
            (int)$dt->format('d')
        );
    }

    /**
     * @param Date $object
     *
     * @return bool
     */
    public function laterThan(Date $object): bool
    {
        return (
                $this->getYear() > $object->getYear()
            )
            ||
            (
                $this->getYear() >= $object->getYear() &&
                $this->getMonth() > $object->getMonth()
            )
            ||
            (
                $this->getYear() >= $object->getYear() &&
                $this->getMonth() >= $object->getMonth() &&
                $this->getDay() > $object->getDay()
            );
    }

    /**
     * @param Date $object
     *
     * @return bool
     */
    public function earlierThan(Date $object): bool
    {
        return !$this->equalsTo($object) && !$this->laterThan($object);
    }

    /**
     * @param Date $object
     *
     * @return bool
     */
    public function equalsTo(Date $object): bool
    {
        return
            $this->getYear() === $object->getYear() &&
            $this->getMonth() === $object->getMonth() &&
            $this->getDay() === $object->getDay();
    }

    /**
     * @return int
     */
    public function getYear(): int
    {
        return $this->year;
    }

    /**
     * @return int
     */
    public function getMonth(): int
    {
        return $this->month;
    }

    /**
     * @return int
     */
    public function getDay(): int
    {
        return $this->day;
    }
}
