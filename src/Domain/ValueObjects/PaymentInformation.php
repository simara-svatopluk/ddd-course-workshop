<?php

declare(strict_types=1);

namespace DDDWorkshop\Domain\ValueObjects;

class PaymentInformation
{
    /**
     * @var string
     */
    private $label;

    /**
     * PaymentInformation constructor.
     * @param string $label
     */
    public function __construct(string $label)
    {
        $this->label = $label;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }
}
