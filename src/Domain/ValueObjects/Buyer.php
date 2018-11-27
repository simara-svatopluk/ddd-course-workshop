<?php

declare(strict_types=1);

namespace DDDWorkshop\Domain\ValueObjects;

class Buyer
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $address;
    /**
     * @var ICO
     */
    private $ico;

    /**
     * Buyer constructor.
     * @param string $name
     * @param string $address
     * @param ICO|null $ico
     */
    public function __construct(string $name, string $address, ?ICO $ico)
    {
        $this->name = $name;
        $this->address = $address;
        $this->ico = $ico;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @return ICO
     */
    public function getIco(): ICO
    {
        return $this->ico ?? new NullICO('');
    }
}
