<?php

declare(strict_types=1);

namespace DDDWorkshop\Domain\ValueObjects;

use Carbon\Carbon;

class DateOfPayment
{
    /**
     * @var Carbon
     */
    private $date;

    /**
     * @param Carbon $date
     */
    public function __construct(Carbon $date)
    {
        $this->date = $date;
    }

    /**
     * @return Carbon
     */
    public function getDate(): Carbon
    {
        return $this->date;
    }
}
