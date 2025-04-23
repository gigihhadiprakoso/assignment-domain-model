<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\Domain\ValueObject\SyaratYudisiumId;
use Ramsey\Uuid\Uuid;

class SyaratYudisiumIdTest extends TestCase
{
    public function testCanBeCreatedWithValidUuid()
    {
        $uuid = Uuid::uuid4()->toString();
        $syaratYudisiumId = new SyaratYudisiumId($uuid);

        $this->assertInstanceOf(SyaratYudisiumId::class, $syaratYudisiumId);
        $this->assertEquals($uuid, $syaratYudisiumId->id());
    }

    public function testThrowsExceptionWithInvalidUuid()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid class SyaratYudisiumId format.");

        new SyaratYudisiumId('invalid-uuid');
    }

    public function testEqualsReturnsTrueForSameUuid()
    {
        $uuid = Uuid::uuid4()->toString();
        $id1 = new SyaratYudisiumId($uuid);
        $id2 = new SyaratYudisiumId($uuid);

        $this->assertTrue($id1->equals($id2));
    }

    public function testEqualsReturnsFalseForDifferentUuids()
    {
        $id1 = new SyaratYudisiumId(Uuid::uuid4()->toString());
        $id2 = new SyaratYudisiumId(Uuid::uuid4()->toString());

        $this->assertFalse($id1->equals($id2));
    }
}
