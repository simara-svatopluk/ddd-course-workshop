<?php

declare(strict_types=1);

namespace DDDWorkshop\Domain;

class TotalAmount
{
    private $amount;
    
    public function toFloat(): float
    {
        return (float)$this->amount;
    }
}
