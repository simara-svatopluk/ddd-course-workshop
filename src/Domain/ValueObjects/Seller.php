<?php

declare(strict_types=1);

namespace DDDWorkshop\Domain\ValueObjects;

class Seller
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
     * @param string $name
     * @param string $address
     * @param ICO $ico
     */
    public function __construct(string $name, string $address, ICO $ico)
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
        return $this->ico;
    }
}
