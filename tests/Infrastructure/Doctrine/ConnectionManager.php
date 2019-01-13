<?php

declare(strict_types=1);

namespace DDDWorkshop\Infrastructure\Doctrine;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Driver;
use Doctrine\DBAL\Driver\PDOPgSql\Driver as PgSqlDriver;
use Doctrine\DBAL\Driver\PDOMySql\Driver as MySqlDriver;
use Doctrine\DBAL\Driver\PDOSqlite\Driver as SqliteDriver;
use Exception;

final class ConnectionManager
{
    public static function createConnectionFromGlobals(): Connection
    {
        $driver = self::getDriver();
        if ($driver instanceof SqliteDriver) {
            return new Connection([
                'memory' => true,
            ], $driver);
        }

        return new Connection([
            'user' => self::getUser(),
            'password' => self::getPassword(),
            'dbname' => self::getDbName(),
            'host' => self::getHost(),
        ], $driver);
    }

    public static function dropAndCreateDatabaseFromGlobals(): void
    {
        $driver = self::getDriver();
        if ($driver instanceof SqliteDriver) {
            return;
        }

        $connection = new Connection([
            'user' => self::getUser(),
            'password' => self::getPassword(),
            'host' => self::getHost(),
        ], $driver);

        $connection->exec(sprintf('DROP DATABASE IF EXISTS %s', self::getDbName()));
        $connection->exec(sprintf('CREATE DATABASE %s', self::getDbName()));
    }

    private static function getUser(): ?string
    {
        return $GLOBALS['DB_USER'] ?? null;
    }

    private static function getPassword(): ?string
    {
        return $GLOBALS['DB_PASSWORD'] ?? null;
    }

    private static function getHost(): ?string
    {
        return $GLOBALS['DB_HOST'] ?? null;
    }

    private static function getDriver(): Driver
    {
        if (!isset($GLOBALS['DB_DRIVER'])) {
            throw new Exception('you have to provide at least DB_DRIVER global parameter');
        }

        $implementedDrivers = [
            'pdo_pgsql',
            'pdo_mysql',
            'pdo_sqlite',
        ];

        $driver = $GLOBALS['DB_DRIVER'];

        if (!in_array($driver, $implementedDrivers, true)) {
            $message = sprintf(
                'Database driver "%s" is not implemented. Choose one of: %s',
                $driver,
                implode(', ', $implementedDrivers)
            );
            throw new Exception($message);
        }

        if ($GLOBALS['DB_DRIVER'] === 'pdo_pgsql') {
            return new PgSqlDriver();
        }

        if ($GLOBALS['DB_DRIVER'] === 'pdo_mysql') {
            return new MySqlDriver();
        }

        if ($GLOBALS['DB_DRIVER'] === 'pdo_sqlite') {
            return new SqliteDriver();
        }
    }

    private static function getDbName(): ?string
    {
        return $GLOBALS['DB_NAME'] ?? null;
    }
}
