<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\ValueObject;

use App\Domain\Entity\SyaratPeriodeYudisium;
use App\Domain\ValueObject\SyaratPeriodeYudisiumId;
use App\Domain\ValueObject\PeriodeYudisiumId;
use App\Domain\ValueObject\SyaratYudisiumId;
use PHPUnit\Framework\TestCase;

class SyaratPeriodeYudisiumTest extends TestCase
{
    public function testCanBeCreatedAndGettersWork()
    {
        $id = new SyaratPeriodeYudisiumId('7dfd8e7e-aa4f-4a3d-9a9a-1a1a1a1a1a1a');
        $periodeId = new PeriodeYudisiumId('8dfd8e7e-bb4f-4b3d-9b9b-2b2b2b2b2b2b');
        $syaratId = new SyaratYudisiumId('9dfd8e7e-cc4f-4c3d-9c9c-3c3c3c3c3c3c');
        
        $syaratPeriode = new SyaratPeriodeYudisium(
            $id,
            $periodeId,
            $syaratId,
            true,
            false
        );

        $this->assertSame($id, $syaratPeriode->getId());
        $this->assertSame($periodeId, $syaratPeriode->getPeriodeYudisiumId());
        $this->assertSame($syaratId, $syaratPeriode->getSyaratYudisiumId());
        $this->assertTrue($syaratPeriode->isUpload());
        $this->assertFalse($syaratPeriode->isMandatory());
    }

    public function testBooleanProperties()
    {
        $id = new SyaratPeriodeYudisiumId('7dfd8e7e-aa4f-4a3d-9a9a-1a1a1a1a1a1a');
        $periodeId = new PeriodeYudisiumId('8dfd8e7e-bb4f-4b3d-9b9b-2b2b2b2b2b2b');
        $syaratId = new SyaratYudisiumId('9dfd8e7e-cc4f-4c3d-9c9c-3c3c3c3c3c3c');
        
        // Test with both true
        $syaratPeriode1 = new SyaratPeriodeYudisium(
            $id,
            $periodeId,
            $syaratId,
            true,
            true
        );
        $this->assertTrue($syaratPeriode1->isUpload());
        $this->assertTrue($syaratPeriode1->isMandatory());

        // Test with both false
        $syaratPeriode2 = new SyaratPeriodeYudisium(
            $id,
            $periodeId,
            $syaratId,
            false,
            false
        );
        $this->assertFalse($syaratPeriode2->isUpload());
        $this->assertFalse($syaratPeriode2->isMandatory());
    }

    public function testImmutability()
    {
        $id = new SyaratPeriodeYudisiumId('7dfd8e7e-aa4f-4a3d-9a9a-1a1a1a1a1a1a');
        $periodeId = new PeriodeYudisiumId('8dfd8e7e-bb4f-4b3d-9b9b-2b2b2b2b2b2b');
        $syaratId = new SyaratYudisiumId('9dfd8e7e-cc4f-4c3d-9c9c-3c3c3c3c3c3c');
        
        $syaratPeriode = new SyaratPeriodeYudisium(
            $id,
            $periodeId,
            $syaratId,
            true,
            false
        );

        // Verify that properties are private and cannot be modified
        $reflection = new \ReflectionClass($syaratPeriode);
        
        $this->assertTrue($reflection->getProperty('id')->isPrivate());
        $this->assertTrue($reflection->getProperty('periodeYudisiumId')->isPrivate());
        $this->assertTrue($reflection->getProperty('syaratYudisiumId')->isPrivate());
        $this->assertTrue($reflection->getProperty('isUpload')->isPrivate());
        $this->assertTrue($reflection->getProperty('isMandatory')->isPrivate());
    }
}