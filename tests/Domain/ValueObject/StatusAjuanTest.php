<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\Domain\ValueObject\StatusAjuan;

class StatusAjuanTest extends TestCase
{
    public function testCanBeCreatedWithValidStatus()
    {
        $status = new StatusAjuan(StatusAjuan::DRAFT);
        $this->assertEquals(StatusAjuan::DRAFT, $status->getStatus());
    }

    public function testThrowsExceptionWithInvalidStatus()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Status not valid");

        new StatusAjuan('X');
    }

    public function testEqualsReturnsTrueForSameStatus()
    {
        $s1 = new StatusAjuan(StatusAjuan::APPROVED);
        $s2 = new StatusAjuan(StatusAjuan::APPROVED);

        $this->assertTrue($s1->equals($s2));
    }

    public function testEqualsReturnsFalseForDifferentStatus()
    {
        $s1 = new StatusAjuan(StatusAjuan::DRAFT);
        $s2 = new StatusAjuan(StatusAjuan::REVISED);

        $this->assertFalse($s1->equals($s2));
    }

    public function testIsMethods()
    {
        $this->assertTrue((new StatusAjuan(StatusAjuan::DRAFT))->isDraft());
        $this->assertTrue((new StatusAjuan(StatusAjuan::VERIFYING))->isVerifying());
        $this->assertTrue((new StatusAjuan(StatusAjuan::REVISED))->isRevised());
        $this->assertTrue((new StatusAjuan(StatusAjuan::APPROVED))->isApproved());
    }

    public function testStaticConstructors()
    {
        $this->assertEquals(StatusAjuan::DRAFT, StatusAjuan::draft()->getStatus());
        $this->assertEquals(StatusAjuan::VERIFYING, StatusAjuan::verifying()->getStatus());
        $this->assertEquals(StatusAjuan::REVISED, StatusAjuan::revised()->getStatus());
        $this->assertEquals(StatusAjuan::APPROVED, StatusAjuan::approved()->getStatus());
    }
}
