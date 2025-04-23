<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Entity;

use App\Domain\Entity\Mahasiswa;
use App\Domain\ValueObject\MahasiswaId;
use PHPUnit\Framework\TestCase;

class MahasiswaTest extends TestCase
{
    public function testCanBeCreatedWithValidData()
    {
        $id = new MahasiswaId('550e8400-e29b-41d4-a716-446655440000');
        $nama = 'John Doe';

        $mahasiswa = new Mahasiswa($id, $nama);

        $this->assertSame($id, $mahasiswa->getId());
        $this->assertSame($nama, $mahasiswa->getNama());
    }

    public function testImmutability()
    {
        $id = new MahasiswaId('550e8400-e29b-41d4-a716-446655440000');
        $nama = 'Jane Smith';

        $mahasiswa = new Mahasiswa($id, $nama);

        $reflection = new \ReflectionClass($mahasiswa);
        
        $this->assertTrue($reflection->getProperty('id')->isPrivate());
        $this->assertTrue($reflection->getProperty('nama')->isPrivate());
    }

    public function testStringProperties()
    {
        $id = new MahasiswaId('550e8400-e29b-41d4-a716-446655440000');
        
        // Test with empty string
        $emptyName = '';
        $mahasiswa1 = new Mahasiswa($id, $emptyName);
        $this->assertSame($emptyName, $mahasiswa1->getNama());

        // Test with long string
        $longName = str_repeat('a', 255);
        $mahasiswa2 = new Mahasiswa($id, $longName);
        $this->assertSame($longName, $mahasiswa2->getNama());

        // Test with special characters
        $specialName = 'Mähäsïswä Ünït-Tést';
        $mahasiswa3 = new Mahasiswa($id, $specialName);
        $this->assertSame($specialName, $mahasiswa3->getNama());
    }

    public function testEquality()
    {
        $id1 = new MahasiswaId('550e8400-e29b-41d4-a716-446655440000');
        $id2 = new MahasiswaId('550e8400-e29b-41d4-a716-446655440001');
        
        $mahasiswa1 = new Mahasiswa($id1, 'John Doe');
        $mahasiswa2 = new Mahasiswa($id1, 'John Doe');
        $mahasiswa3 = new Mahasiswa($id2, 'Jane Smith');

        // Objects with same ID should be considered equal
        $this->assertTrue($mahasiswa1->getId()->equals($mahasiswa2->getId()));
        
        // Objects with different IDs should be considered different
        $this->assertFalse($mahasiswa1->getId()->equals($mahasiswa3->getId()));
    }
}