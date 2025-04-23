<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\Domain\ValueObject\SyaratPeriodeYudisiumId;
use Ramsey\Uuid\Uuid;

class SyaratPeriodeYudisiumIdTest extends TestCase
{
    public function testCanBeCreatedWithValidUuid()
    {
        $uuid = Uuid::uuid4()->toString();
        $id = new SyaratPeriodeYudisiumId($uuid);

        $this->assertInstanceOf(SyaratPeriodeYudisiumId::class, $id);
        $this->assertEquals($uuid, $id->id());
    }

    public function testThrowsExceptionWithInvalidUuid()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid class SyaratPeriodeYudisiumId format.");

        new SyaratPeriodeYudisiumId('invalid-uuid');
    }

    public function testEqualsReturnsTrueForSameUuid()
    {
        $uuid = Uuid::uuid4()->toString();
        $id1 = new SyaratPeriodeYudisiumId($uuid);
        $id2 = new SyaratPeriodeYudisiumId($uuid);

        $this->assertTrue($id1->equals($id2));
    }

    public function testEqualsReturnsFalseForDifferentUuids()
    {
        $id1 = new SyaratPeriodeYudisiumId(Uuid::uuid4()->toString());
        $id2 = new SyaratPeriodeYudisiumId(Uuid::uuid4()->toString());

        $this->assertFalse($id1->equals($id2));
    }
}
