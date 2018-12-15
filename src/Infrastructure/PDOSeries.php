<?php

declare(strict_types=1);

namespace DDDWorkshop\Infrastructure;

use DDDWorkshop\Domain\Number;
use DDDWorkshop\Domain\Series;
use PDO;
use PDOException;

final class PDOSeries implements Series
{
    /**
     * @var PDO
     */
    private $pdo;

    /**
     * @var string
     */
    private $prefix;

    public function __construct(PDO $pdo, string $prefix)
    {
        $this->pdo = $pdo;
        $this->prefix = $prefix;
    }

    public function next(): Number
    {
        $statement = $this->pdo->query("SELECT nextval('number_series') number");
        if ($statement === false) {
            throw new PDOException('Something went wrong...');
        }
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $number = (string) $result['number'];
        return new Number($this->prefix, $number);
    }
}
