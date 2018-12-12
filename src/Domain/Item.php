<?php declare(strict_types=1);
namespace DDDWorkshop\Domain;

use DDDWorkshop\Domain\Interfaces\IEquatable;
use DDDWorkshop\Domain\Interfaces\IValueObject;
use Money\Currency;
use Money\Money;

class Item implements IValueObject
{
    private const CZK = 'CZK';

    /** @var Money */
    private $price;

    /** @var string */
    private $name;


    /**
     * @param Money $price
     * @param string $name
     * @throws \DDDWorkshop\Domain\Exceptions\CurrencyIsNotCzkException
     */
    public function __construct(Money $price, string $name)
    {
        if (! $price->getCurrency()->equals(new Currency(self::CZK))) {
            throw new \DDDWorkshop\Domain\Exceptions\CurrencyIsNotCzkException();
        }
        $this->price = $price;
        $this->name = $name;
    }

    /**
     * @return Money
     */
    public function getPrice(): Money
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param IEquatable $other
     * @return bool
     */
    public function equals(IEquatable $other): bool
    {
        return ($other instanceof self
            && $other->price->equals($this->price)
            && $other->name === $this->name);
    }
}
