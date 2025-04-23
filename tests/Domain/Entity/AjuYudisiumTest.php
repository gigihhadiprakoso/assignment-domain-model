<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Entity;

use App\Domain\Entity\AjuYudisium;
use App\Domain\ValueObject\AjuYudisiumId;
use App\Domain\ValueObject\MahasiswaId;
use App\Domain\ValueObject\PeriodeYudisiumId;
use App\Domain\ValueObject\StatusAjuan;
use PHPUnit\Framework\TestCase;

class AjuYudisiumTest extends TestCase
{
    private function createDraftAjuYudisium(): AjuYudisium
    {
        return new AjuYudisium(
            new AjuYudisiumId('550e8400-e29b-41d4-a716-446655440000'),
            new MahasiswaId('660e8400-e29b-41d4-a716-446655440001'),
            new PeriodeYudisiumId('770e8400-e29b-41d4-a716-446655440002'),
            StatusAjuan::draft()
        );
    }

    private function createVerifyingAjuYudisium(): AjuYudisium
    {
        return new AjuYudisium(
            new AjuYudisiumId('550e8400-e29b-41d4-a716-446655440000'),
            new MahasiswaId('660e8400-e29b-41d4-a716-446655440001'),
            new PeriodeYudisiumId('770e8400-e29b-41d4-a716-446655440002'),
            StatusAjuan::verifying()
        );
    }

    public function testCanBeCreatedWithValidData()
    {
        $id = new AjuYudisiumId('550e8400-e29b-41d4-a716-446655440000');
        $mahasiswaId = new MahasiswaId('660e8400-e29b-41d4-a716-446655440001');
        $periodeId = new PeriodeYudisiumId('770e8400-e29b-41d4-a716-446655440002');
        $status = StatusAjuan::draft();

        $ajuYudisium = new AjuYudisium($id, $mahasiswaId, $periodeId, $status);

        $this->assertSame($id, $ajuYudisium->getId());
        $this->assertSame($mahasiswaId, $ajuYudisium->getMahasiswaId());
        $this->assertSame($periodeId, $ajuYudisium->getPeriodeYudisiumId());
        $this->assertSame($status, $ajuYudisium->getStatus());
        $this->assertTrue($ajuYudisium->getStatus()->isDraft());
    }

    public function testAjukanFromDraft()
    {
        $ajuYudisium = $this->createDraftAjuYudisium();
        $ajuYudisium->ajukan();

        $this->assertTrue($ajuYudisium->getStatus()->isVerifying());
    }

    public function testAjukanFromNonDraftThrowsException()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Ajuan tidak dalam status draft.");

        $ajuYudisium = $this->createVerifyingAjuYudisium();
        $ajuYudisium->ajukan();
    }

    public function testRevisiFromVerifying()
    {
        $ajuYudisium = $this->createVerifyingAjuYudisium();
        $ajuYudisium->revisi();

        $this->assertTrue($ajuYudisium->getStatus()->isRevised());
    }

    public function testRevisiFromNonVerifyingThrowsException()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Ajuan tidak dalam status menunggu verifikasi.");

        $ajuYudisium = $this->createDraftAjuYudisium();
        $ajuYudisium->revisi();
    }

    public function testSetujuiFromVerifying()
    {
        $ajuYudisium = $this->createVerifyingAjuYudisium();
        $ajuYudisium->setujui();

        $this->assertTrue($ajuYudisium->getStatus()->isApproved());
    }

    public function testSetujuiFromRevised()
    {
        $ajuYudisium = $this->createVerifyingAjuYudisium();
        $ajuYudisium->revisi(); // status becomes revised
        $ajuYudisium->setujui();

        $this->assertTrue($ajuYudisium->getStatus()->isApproved());
    }

    public function testSetujuiFromInvalidStatusThrowsException()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Ajuan tidak dalam status menunggu verifikasi / revisi.");

        $ajuYudisium = $this->createDraftAjuYudisium();
        $ajuYudisium->setujui();
    }

    public function testImmutability()
    {
        $ajuYudisium = $this->createDraftAjuYudisium();

        $reflection = new \ReflectionClass($ajuYudisium);
        
        $this->assertTrue($reflection->getProperty('id')->isPrivate());
        $this->assertTrue($reflection->getProperty('mahasiswaId')->isPrivate());
        $this->assertTrue($reflection->getProperty('periodeYudisiumId')->isPrivate());
        $this->assertTrue($reflection->getProperty('status')->isPrivate());
    }

    public function testStatusTransitions()
    {
        $ajuYudisium = $this->createDraftAjuYudisium();
        
        // Draft -> Verifying
        $ajuYudisium->ajukan();
        $this->assertTrue($ajuYudisium->getStatus()->isVerifying());
        
        // Verifying -> Revised
        $ajuYudisium->revisi();
        $this->assertTrue($ajuYudisium->getStatus()->isRevised());
        
        // Revised -> Approved
        $ajuYudisium->setujui();
        $this->assertTrue($ajuYudisium->getStatus()->isApproved());
    }
}