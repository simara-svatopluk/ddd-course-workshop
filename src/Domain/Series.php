<?php declare(strict_types=1);
namespace DDDWorkshop\Domain;

interface Series
{
    public function next(): Number;
}
