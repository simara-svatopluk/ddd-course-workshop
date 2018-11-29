<?php

declare(strict_types=1);

namespace DDDWorkshop\Domain\ValueObjects;

use Carbon\Carbon;
use DDDWorkshop\Domain\Exceptions\DateOfPaymentIsBeforeDateOfIssue;

class DateOfIssue
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

    public function checkIsBefore(DateOfPayment $dateOfPayment): void
    {
        if ($this->getDate()->greaterThanOrEqualTo($dateOfPayment->getDate())) {
            throw new DateOfPaymentIsBeforeDateOfIssue($this, $dateOfPayment);
        }
    }

    /**
     * @return Carbon
     */
    public function getDate(): Carbon
    {
        return $this->date;
    }
}
