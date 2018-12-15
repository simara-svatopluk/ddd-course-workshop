<?php

declare(strict_types=1);

namespace DDDWorkshop\Domain;

final class Number
{
    private const NUMBER_LENGTH = 5;

    /**
     * @var string
     */
    private $number;

    public function __construct(string $prefix, string $number)
    {
        $paddedNumber = str_pad($number, self::NUMBER_LENGTH, '0', STR_PAD_LEFT);
        $formattedNumber = sprintf('%s/%s', $prefix, $paddedNumber);

        $this->number = $formattedNumber;
    }
}
