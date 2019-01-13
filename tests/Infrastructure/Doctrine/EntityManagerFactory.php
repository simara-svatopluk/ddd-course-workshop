<?php

declare(strict_types=1);

namespace DDDWorkshop\Infrastructure\Doctrine;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\SimplifiedXmlDriver;
use Doctrine\ORM\Proxy\ProxyFactory;
use Doctrine\ORM\Tools\SchemaTool;

final class EntityManagerFactory
{
    public static function createEntityManager(
        Connection $connection,
        array $schemaClassNames,
        array $types
    ): EntityManager {
        $config = new Configuration();

        $namespaces = [
            __DIR__ . '/../../../src/Infrastructure/Doctrine' => 'DDDWorkshop\\Domain'
        ];
        $xmlDriver = new SimplifiedXmlDriver($namespaces, '.xml');

        $config->setMetadataDriverImpl($xmlDriver);

        $config->setProxyDir(__DIR__);
        $config->setProxyNamespace('Doctrine\Tests\Proxies');
        $config->setAutoGenerateProxyClasses(ProxyFactory::AUTOGENERATE_NEVER);

        $platform = $connection->getDatabasePlatform();
        foreach ($types as $class => $name) {
            self::registerType($platform, $class, $name);
        }
        $entityManager = EntityManager::create($connection, $config);

        $metadata = array_map(function ($className) use ($entityManager) {
            return $entityManager->getClassMetadata($className);
        }, $schemaClassNames);

        $schemaTool = new SchemaTool($entityManager);
        $schemaTool->createSchema($metadata);

        return $entityManager;
    }

    private static function registerType(AbstractPlatform $platform, string $class, string $name)
    {
        if (!Type::hasType($name)) {
            Type::addType($name, $class);
        }
        $platform->registerDoctrineTypeMapping($name, $name);
    }
}
