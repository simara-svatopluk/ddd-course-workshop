<?php declare(strict_types=1);
namespace DDDWorkshop\Domain;

use DDDWorkshop\Domain\Interfaces\IEquatable;
use DDDWorkshop\Domain\Interfaces\IValueObject;
use Nette\Utils\Validators;
use function sprintf;

class Items implements IValueObject
{
    /** @var Item[] */
    private $items;


    /**
     * @param Item[] $items
     * @throws \DDDWorkshop\Domain\Exceptions\InvalidArgumentException
     */
    public function __construct(array $items)
    {
        if (! Validators::everyIs($items, Item::class)) {
            $errorMessage = sprintf('Parameter "items" must be array of %s.', Item::class);
            throw new \DDDWorkshop\Domain\Exceptions\InvalidArgumentException($errorMessage);
        }
        $this->items = $items;
    }

    /**
     * @return Item[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param IEquatable $other
     * @return bool
     */
    public function equals(IEquatable $other): bool
    {
        //TODO: implement
        return false;
    }

    /**
     * @return TotalAmount
     */
    public function getTotalAmount(): TotalAmount
    {
        //TODO: implement
    }
}
