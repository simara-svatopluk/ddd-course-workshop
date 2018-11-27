<?php

declare(strict_types=1);

namespace DDDWorkshop\Domain\Exceptions;

use DDDWorkshop\Domain\ValueObjects\Seller;
use Exception;
use Throwable;

class SellerIsOnRegistrNespolehlivychPlatcu extends Exception
{
    /**
     * @var Seller
     */
    private $seller;

    public function __construct(Seller $seller, Throwable $previous = null)
    {
        parent::__construct("Seller is present on Registr Nespolehlivych Platcu", 0, $previous);

        $this->seller = $seller;
    }

    /**
     * @return Seller
     */
    public function getSeller(): Seller
    {
        return $this->seller;
    }
}
