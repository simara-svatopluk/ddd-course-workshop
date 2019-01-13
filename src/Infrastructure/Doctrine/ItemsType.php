<?php

declare(strict_types=1);

namespace DDDWorkshop\Infrastructure\Doctrine;

use DDDWorkshop\Domain\Crown;
use DDDWorkshop\Domain\Item;
use DDDWorkshop\Domain\Items;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class ItemsType extends Type
{
    const NAME = 'itemsType';

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        if ($platform->hasNativeJsonType()) {
            return 'JSON';
        }
        return 'TEXT';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        $data = json_decode($value, true);

        $items = [];
        foreach ($data as $row) {
            $items[] = new Item($row['text'], new Crown($row['price']));
        }

        return new Items($items);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (! $value instanceof Items) {
            throw new \Exception(sprintf('Converting a wrong type, have to be Items, is %s', get_class($value)));
        }

        $data = [];
        foreach ($value->getItems() as $item) {
            $data[] = [
                'price' => $item->getPrice()->toHellers(),
                'text' => $item->getText(),
            ];
        }

        return json_encode($data);
    }

    public function getName()
    {
        self::NAME;
    }
}
