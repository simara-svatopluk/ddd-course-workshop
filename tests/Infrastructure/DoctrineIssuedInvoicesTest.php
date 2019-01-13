<?php

declare(strict_types=1);

namespace DDDWorkshop\Infrastructure;

use DDDWorkshop\Domain\IssuedInvoice;
use DDDWorkshop\Domain\IssuedInvoices;
use DDDWorkshop\Domain\IssuedInvoicesTest;
use DDDWorkshop\Infrastructure\Doctrine\ConnectionManager;
use DDDWorkshop\Infrastructure\Doctrine\EntityManagerFactory;
use DDDWorkshop\Infrastructure\Doctrine\ItemsType;
use DDDWorkshop\Infrastructure\Doctrine\NumberType;
use Doctrine\ORM\EntityManager;

final class DoctrineIssuedInvoicesTest extends IssuedInvoicesTest
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    protected function setUp()
    {
        $mappedClasses = [IssuedInvoice::class];
        $customTypes = [
            NumberType::class => NumberType::NAME,
            ItemsType::class => ItemsType::NAME,
        ];

        ConnectionManager::dropAndCreateDatabaseFromGlobals();
        $connection = ConnectionManager::createConnectionFromGlobals();
        $this->entityManager = EntityManagerFactory::createEntityManager($connection, $mappedClasses, $customTypes);
        parent::setUp();
    }

    protected function flush(): void
    {
        $this->entityManager->flush();
        $this->entityManager->clear();
    }

    protected function tearDown()
    {
        parent::tearDown();
        $this->entityManager->getConnection()->close();
    }

    protected function createIssuedInvoices(): IssuedInvoices
    {
        return new DoctrineIssuedInvoices($this->entityManager);
    }
}
