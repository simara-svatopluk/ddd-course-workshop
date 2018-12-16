<?php

declare(strict_types=1);

namespace DDDWorkshop\Domain;

final class Crown
{
    /**
     * @var int
     */
    private $hellers;

    public function __construct(int $hellers)
    {
        $this->hellers = $hellers;
    }

    public static function fromCrowns(float $crowns): self
    {
        return new self((int)($crowns * 100));
    }

    public function toHellers(): int
    {
        return $this->hellers;
    }

    public function isEqual(self $compared): bool
    {
        return $this->hellers === $compared->hellers;
    }
}
