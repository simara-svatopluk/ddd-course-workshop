<?php

declare(strict_types=1);

namespace DDDWorkshop\Domain\Exceptions;

use DDDWorkshop\Domain\ValueObjects\DateOfIssue;
use DDDWorkshop\Domain\ValueObjects\DateOfPayment;
use Exception;
use Throwable;

class DateOfPaymentIsBeforeDateOfIssue extends Exception
{
    /**
     * @var DateOfIssue
     */
    private $dateOfIssue;
    /**
     * @var DateOfPayment
     */
    private $dateOfPayment;

    public function __construct(DateOfIssue $dateOfIssue, DateOfPayment $dateOfPayment, Throwable $previous = null)
    {
        parent::__construct("Date of issue is before Date of payment", 0, $previous);

        $this->dateOfIssue = $dateOfIssue;
        $this->dateOfPayment = $dateOfPayment;
    }

    /**
     * @return DateOfIssue
     */
    public function getDateOfIssue(): DateOfIssue
    {
        return $this->dateOfIssue;
    }

    /**
     * @return DateOfPayment
     */
    public function getDateOfPayment(): DateOfPayment
    {
        return $this->dateOfPayment;
    }
}
