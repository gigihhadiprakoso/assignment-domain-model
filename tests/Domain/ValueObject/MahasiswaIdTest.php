<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\Domain\ValueObject\MahasiswaId;
use Ramsey\Uuid\Uuid;

class MahasiswaIdTest extends TestCase
{
    public function testCanBeCreatedWithValidUuid()
    {
        $uuid = Uuid::uuid4()->toString();
        $mahasiswaId = new MahasiswaId($uuid);
        
        $this->assertInstanceOf(MahasiswaId::class, $mahasiswaId);
        $this->assertEquals($uuid, $mahasiswaId->id());
    }

    public function testThrowsExceptionWithInvalidUuid()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid class MahasiswaId format.");
        
        new MahasiswaId('not-a-valid-uuid');
    }

    public function testEqualsReturnsTrueForSameUuid()
    {
        $uuid = Uuid::uuid4()->toString();
        $mahasiswaId1 = new MahasiswaId($uuid);
        $mahasiswaId2 = new MahasiswaId($uuid);
        
        $this->assertTrue($mahasiswaId1->equals($mahasiswaId2));
    }

    public function testEqualsReturnsFalseForDifferentUuids()
    {
        $mahasiswaId1 = new MahasiswaId(Uuid::uuid4()->toString());
        $mahasiswaId2 = new MahasiswaId(Uuid::uuid4()->toString());
        
        $this->assertFalse($mahasiswaId1->equals($mahasiswaId2));
    }
}
