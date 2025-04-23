<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Entity;

use App\Domain\Entity\SyaratYudisium;
use App\Domain\ValueObject\SyaratYudisiumId;
use PHPUnit\Framework\TestCase;

class SyaratYudisiumTest extends TestCase
{
    public function testCanBeCreatedWithValidData()
    {
        $id = new SyaratYudisiumId('550e8400-e29b-41d4-a716-446655440000');
        $nama = 'Transkrip Nilai';
        $keterangan = 'Transkrip nilai terakhir yang telah dilegalisir';

        $syarat = new SyaratYudisium($id, $nama, $keterangan);

        $this->assertSame($id, $syarat->getId());
        $this->assertSame($nama, $syarat->getNama());
        $this->assertSame($keterangan, $syarat->getKeterangan());
    }

    public function testImmutability()
    {
        $id = new SyaratYudisiumId('550e8400-e29b-41d4-a716-446655440000');
        $nama = 'Ijazah';
        $keterangan = 'Ijazah asli dari universitas';

        $syarat = new SyaratYudisium($id, $nama, $keterangan);

        $reflection = new \ReflectionClass($syarat);
        
        $this->assertTrue($reflection->getProperty('id')->isPrivate());
        $this->assertTrue($reflection->getProperty('nama')->isPrivate());
        $this->assertTrue($reflection->getProperty('keterangan')->isPrivate());
    }

    public function testStringProperties()
    {
        $id = new SyaratYudisiumId('550e8400-e29b-41d4-a716-446655440000');
        
        // Test with empty strings
        $syarat1 = new SyaratYudisium($id, '', '');
        $this->assertSame('', $syarat1->getNama());
        $this->assertSame('', $syarat1->getKeterangan());

        // Test with long strings
        $longName = str_repeat('a', 255);
        $longKeterangan = str_repeat('b', 1000);
        $syarat2 = new SyaratYudisium($id, $longName, $longKeterangan);
        $this->assertSame($longName, $syarat2->getNama());
        $this->assertSame($longKeterangan, $syarat2->getKeterangan());
    }

    public function testEquality()
    {
        $id1 = new SyaratYudisiumId('550e8400-e29b-41d4-a716-446655440000');
        $id2 = new SyaratYudisiumId('550e8400-e29b-41d4-a716-446655440001');
        
        $syarat1 = new SyaratYudisium($id1, 'Nama', 'Keterangan');
        $syarat2 = new SyaratYudisium($id1, 'Nama', 'Keterangan');
        $syarat3 = new SyaratYudisium($id2, 'Nama Lain', 'Keterangan Lain');

        // Objects with same ID should be considered equal
        $this->assertTrue($syarat1->getId()->equals($syarat2->getId()));
        
        // Objects with different IDs should be considered different
        $this->assertFalse($syarat1->getId()->equals($syarat3->getId()));
    }
}