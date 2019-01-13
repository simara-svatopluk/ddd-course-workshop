<?php

declare(strict_types=1);

namespace DDDWorkshop\Infrastructure\Doctrine;

use DDDWorkshop\Domain\Number;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class NumberType extends Type
{
    const NAME = 'numberType';

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return 'VARCHAR(255)';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return Number::fromString($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if ($value instanceof Number) {
            return $value->toString();
        }
        return $value;
    }

    public function getName()
    {
        self::NAME;
    }
}
