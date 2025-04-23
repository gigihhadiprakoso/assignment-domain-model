<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Entity;

use App\Domain\Entity\PeriodeYudisium;
use App\Domain\ValueObject\PeriodeId;
use App\Domain\ValueObject\PeriodeYudisiumId;
use PHPUnit\Framework\TestCase;

class PeriodeYudisiumTest extends TestCase
{
    public function testCanBeCreatedWithValidData()
    {
        $id = new PeriodeYudisiumId('550e8400-e29b-41d4-a716-446655440000');
        $periodeId = new PeriodeId('20231');
        $nama = 'Yudisium Semester Ganjil 2023/2024';

        $periodeYudisium = new PeriodeYudisium($id, $periodeId, $nama);

        $this->assertSame($id, $periodeYudisium->getId());
        $this->assertSame($periodeId, $periodeYudisium->getPeriodeId());
        $this->assertSame($nama, $periodeYudisium->getNama());
    }

    public function testImmutability()
    {
        $id = new PeriodeYudisiumId('550e8400-e29b-41d4-a716-446655440000');
        $periodeId = new PeriodeId('20222');
        $nama = 'Yudisium Semester Genap 2022/2023';

        $periodeYudisium = new PeriodeYudisium($id, $periodeId, $nama);

        $reflection = new \ReflectionClass($periodeYudisium);
        
        $this->assertTrue($reflection->getProperty('id')->isPrivate());
        $this->assertTrue($reflection->getProperty('periodeId')->isPrivate());
        $this->assertTrue($reflection->getProperty('nama')->isPrivate());
    }

    public function testStringProperties()
    {
        $id = new PeriodeYudisiumId('550e8400-e29b-41d4-a716-446655440000');
        $periodeId = new PeriodeId('20231');
        
        // Test with empty string
        $emptyName = '';
        $periodeYudisium1 = new PeriodeYudisium($id, $periodeId, $emptyName);
        $this->assertSame($emptyName, $periodeYudisium1->getNama());

        // Test with long string
        $longName = str_repeat('a', 255);
        $periodeYudisium2 = new PeriodeYudisium($id, $periodeId, $longName);
        $this->assertSame($longName, $periodeYudisium2->getNama());

        // Test with special characters
        $specialName = 'Yudisium 2023/2024 - Semester Gänjil (Ünittest)';
        $periodeYudisium3 = new PeriodeYudisium($id, $periodeId, $specialName);
        $this->assertSame($specialName, $periodeYudisium3->getNama());
    }

    public function testEquality()
    {
        $id1 = new PeriodeYudisiumId('550e8400-e29b-41d4-a716-446655440000');
        $id2 = new PeriodeYudisiumId('550e8400-e29b-41d4-a716-446655440001');
        $periodeId = new PeriodeId('20241');
        
        $periodeYudisium1 = new PeriodeYudisium($id1, $periodeId, 'Yudisium 2023');
        $periodeYudisium2 = new PeriodeYudisium($id1, $periodeId, 'Yudisium 2023');
        $periodeYudisium3 = new PeriodeYudisium($id2, $periodeId, 'Yudisium 2024');

        // Objects with same ID should be considered equal
        $this->assertTrue($periodeYudisium1->getId()->equals($periodeYudisium2->getId()));
        
        // Objects with different IDs should be considered different
        $this->assertFalse($periodeYudisium1->getId()->equals($periodeYudisium3->getId()));
    }

    public function testPeriodeIdConsistency()
    {
        $id = new PeriodeYudisiumId('550e8400-e29b-41d4-a716-446655440000');
        $periodeId1 = new PeriodeId('20201');
        $periodeId2 = new PeriodeId('20202');
        
        $periodeYudisium1 = new PeriodeYudisium($id, $periodeId1, 'Yudisium 2023');
        $periodeYudisium2 = new PeriodeYudisium($id, $periodeId2, 'Yudisium 2023');

        // Verify periodeId is properly stored and returned
        $this->assertSame($periodeId1, $periodeYudisium1->getPeriodeId());
        $this->assertSame($periodeId2, $periodeYudisium2->getPeriodeId());
        $this->assertFalse($periodeYudisium1->getPeriodeId()->equals($periodeYudisium2->getPeriodeId()));
    }
}