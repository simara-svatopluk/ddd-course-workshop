<?php

declare(strict_types=1);

namespace DDDWorkshop\Domain\ValueObjects;

use InvalidArgumentException;

class ICO
{
    private const ICO_PATTERN = '#^\d{8}$#';
    /**
     * @var string $ico
     */
    private $ico;

    /**
     * @param string $ico
     */
    public function __construct(string $ico)
    {
        $this->ico = $this->validate($ico);
    }

    protected function validate(string $ico): string
    {
        // has correct pattern
        if (!preg_match(self::ICO_PATTERN, $ico)) {
            throw new InvalidArgumentException('Invalid ICO pattern');
        }

        // checksum
        $c = $this->calculateChecksum($ico);

        if ($this->checkChecksum($c, $ico)) {
            return $ico;
        }

        throw new InvalidArgumentException('Invalid ICO');
    }

    protected function checkChecksum(int $checksum, string $ico): bool
    {
        return (int)$ico[7] === $checksum;
    }

    protected function calculateChecksum(string $ico): int
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
