<?php

declare(strict_types=1);

namespace DDDWorkshop\Infrastructure;

use DDDWorkshop\Domain\Exception;
use DDDWorkshop\Domain\IssuedInvoice;
use DDDWorkshop\Domain\IssuedInvoices;
use DDDWorkshop\Domain\Number;
use Doctrine\ORM\EntityManagerInterface;

final class DoctrineIssuedInvoices implements IssuedInvoices
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function add(IssuedInvoice $issuedInvoice): void
    {
        $this->entityManager->persist($issuedInvoice);
    }

    public function get(Number $number): IssuedInvoice
    {
        $found = $this->entityManager->find(IssuedInvoice::class, $number->toString());
        if ($found instanceof IssuedInvoice) {
            return $found;
        }
        throw new Exception();
    }

    public function remove(Number $number): void
    {
        $this->entityManager->remove($this->get($number));
    }
}
