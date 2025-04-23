<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\Domain\ValueObject\PeriodeYudisiumId;
use Ramsey\Uuid\Uuid;

class PeriodeYudisiumIdTest extends TestCase
{
    public function testCanBeCreatedWithValidUuid()
    {
        $uuid = Uuid::uuid4()->toString();
        $id = new PeriodeYudisiumId($uuid);

        $this->assertInstanceOf(PeriodeYudisiumId::class, $id);
        $this->assertEquals($uuid, $id->id());
    }

    public function testThrowsExceptionWithInvalidUuid()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid class PeriodeYudisiumId format.");

        new PeriodeYudisiumId('invalid-uuid');
    }

    public function testEqualsReturnsTrueForSameUuid()
    {
        $uuid = Uuid::uuid4()->toString();
        $id1 = new PeriodeYudisiumId($uuid);
        $id2 = new PeriodeYudisiumId($uuid);

        $this->assertTrue($id1->equals($id2));
    }

    public function testEqualsReturnsFalseForDifferentUuids()
    {
        $id1 = new PeriodeYudisiumId(Uuid::uuid4()->toString());
        $id2 = new PeriodeYudisiumId(Uuid::uuid4()->toString());

        $this->assertFalse($id1->equals($id2));
    }
}
