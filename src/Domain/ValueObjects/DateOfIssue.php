<?php

declare(strict_types=1);

namespace DDDWorkshop\Domain\ValueObjects;

class DateOfIssue
{
    /**
     * @var Date
     */
    private $date;

    /**
     * DateOfIssue constructor.
     * @param Date $date
     */
    public function __construct(Date $date)
    {
        $this->date = $date;
    }

    /**
     * @return Date
     */
    public function getDate(): Date
    {
        return $this->date;
    }
}
