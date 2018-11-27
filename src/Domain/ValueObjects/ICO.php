<?php

declare(strict_types=1);

namespace DDDWorkshop\Domain\ValueObjects;

use InvalidArgumentException;

class ICO
{
    protected $ico_pattern = '#^\d{8}$#';
    /**
     * @var string $ico
     */
    private $ico;

    /**
     * ICO constructor.
     * @param string $ico
     */
    public function __construct(string $ico)
    {
        $this->ico = $this->validate($ico);
    }

    protected function validate(string $ico): string
    {
        // has correct pattern
        if (!preg_match($this->ico_pattern, $ico)) {
            throw new InvalidArgumentException('Invalid ICO pattern');
        }

        // checksum
        $c = $this->calculateChecksum($ico);

        if ((int)$ico[7] === $c) {
            return $ico;
        }

        throw new InvalidArgumentException('Invalid ICO');
    }

    protected function calculateChecksum($ico): int
    {
        $a = 0;
        for ($i = 0; $i < 7; $i++) {
            $a += $ico[$i] * (8 - $i);
        }

        $a = $a % 11;
        if ($a === 0) {
            $c = 1;
        } elseif ($a === 1) {
            $c = 0;
        } else {
            $c = 11 - $a;
        }

        return $c;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getIco();
    }

    /**
     * @return string
     */
    public function getIco(): string
    {
        return $this->ico;
    }
}
