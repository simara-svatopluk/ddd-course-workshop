<?php declare(strict_types=1);
namespace DDDWorkshop\Domain;

use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \DDDWorkshop\Domain\DateOfIssue
 */
class DateOfIssueTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testEquals(): void
    {
        $date1 = new DateTimeImmutable('2018-12-12 20:20:20');
        $date1b = new DateTimeImmutable('2018-12-12 21:21:21');
        $date2 = new DateTimeImmutable('2019-01-01 20:20:20');
        $dateOfIssue1 = new DateOfIssue($date1);
        $dateOfIssue1b = new DateOfIssue($date1b);
        $dateOfIssue2 = new DateOfIssue($date2);
        self::assertTrue($dateOfIssue1->equals($dateOfIssue1b));
        self::assertFalse($dateOfIssue1->equals($dateOfIssue2));
    }
}
