<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\Domain\ValueObject\AjuYudisiumId;
use Ramsey\Uuid\Uuid;

class AjuYudisiumIdTest extends TestCase
{
    public function testCanBeCreatedWithValidUuid()
    {
        $uuid = Uuid::uuid4()->toString();
        $id = new AjuYudisiumId($uuid);

        $this->assertInstanceOf(AjuYudisiumId::class, $id);
        $this->assertEquals($uuid, $id->id());
    }

    public function testThrowsExceptionWithInvalidUuid()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid class AjuYudisiumId format.");

        new AjuYudisiumId('not-a-valid-uuid');
    }

    public function testEqualsReturnsTrueForSameUuid()
    {
        $uuid = Uuid::uuid4()->toString();
        $id1 = new AjuYudisiumId($uuid);
        $id2 = new AjuYudisiumId($uuid);

        $this->assertTrue($id1->equals($id2));
    }

    public function testEqualsReturnsFalseForDifferentUuids()
    {
        $id1 = new AjuYudisiumId(Uuid::uuid4()->toString());
        $id2 = new AjuYudisiumId(Uuid::uuid4()->toString());

        $this->assertFalse($id1->equals($id2));
    }
}
