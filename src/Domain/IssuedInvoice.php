<?php declare(strict_types=1);
namespace DDDWorkshop\Domain;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class IssuedInvoice
{
    /** @var UuidInterface */
    private $id;

    /** @var Buyer */
    private $buyer;

    /** @var Items */
    private $items;

    /** @var DateOfIssue */
    private $dateOfIssue;

    /** @var DateOfPayment */
    private $dateOfPayment;

    /** @var mixed due to phpStan */
    private $number;


    /**
     * @param Buyer $buyer
     * @param Items $items
     * @param DateOfIssue $dateOfIssue
     * @param DateOfPayment $dateOfPayment
     * @param Series $series
     * @param RegistrNespolehlivychPlatcu $registrNespolehlivychPlatcu
     * @throws \Exception
     */
    public function __construct(
        Buyer $buyer,
        Items $items,
        DateOfIssue $dateOfIssue,
        DateOfPayment $dateOfPayment,
        Series $series,
        RegistrNespolehlivychPlatcu $registrNespolehlivychPlatcu
    ) {
        if (! $registrNespolehlivychPlatcu->check($buyer)) {
            throw new \DDDWorkshop\Domain\Exceptions\NespolehlivyPlatceException();
        }
        if ($dateOfIssue > $dateOfPayment) {
            throw new \DDDWorkshop\Domain\Exceptions\DateOfIssueIsGreaterThanDateOfPaymentException();
        }

        $this->id = Uuid::uuid4();
        $this->buyer = $buyer;
        $this->items = $items;
        $this->dateOfIssue = $dateOfIssue;
        $this->dateOfPayment = $dateOfPayment;
        $this->number = $series->next();
    }
}
