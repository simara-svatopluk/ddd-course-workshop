<?php

declare(strict_types=1);

namespace DDDWorkshop\Domain\Exceptions;


use DDDWorkshop\Domain\ValueObjects\ICO;
use Exception;
use Throwable;

class IcoIsOnRegistrNespolehlivychPlatcu extends Exception
{
    protected $ico;

    public function __construct(ICO $ICO, Throwable $previous = null)
    {
        parent::__construct("Ico {$ICO} is on Registr Nespolehlivych Platcu", 0, $previous);
    }

    /**
     * @return mixed
     */
    public function getIco()
    {
        return $this->ico;
    }
}