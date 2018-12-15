<?php

declare(strict_types=1);

namespace DDDWorkshop\Infrastructure;

use DDDWorkshop\Domain\Series;
use DDDWorkshop\Domain\SeriesTest;
use PDO;

final class PDOSeriesTest extends SeriesTest
{
    protected function getSeries(): Series
    {
        $pdo = new PDO('pgsql:host=127.0.0.1;dbname=test', 'postgres', '***');

        $pdo->exec('DROP SEQUENCE IF EXISTS number_series');
        $pdo->exec('CREATE SEQUENCE number_series');
        return new PDOSeries($pdo, '2018');
    }
}
