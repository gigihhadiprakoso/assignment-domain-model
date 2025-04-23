<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\ValueObject\AjuYudisiumId;
use App\Domain\ValueObject\MahasiswaId;
use App\Domain\ValueObject\PeriodeYudisiumId;
use App\Domain\ValueObject\StatusAjuan;

class AjuYudisium {

    private AjuYudisiumId $id;
    private MahasiswaId $mahasiswaId;
    private PeriodeYudisiumId $periodeYudisiumId;
    private StatusAjuan $status;

    public function __construct(
        AjuYudisiumId $id,
        MahasiswaId $mahasiswaId,
        PeriodeYudisiumId $periodeYudisiumId,
        StatusAjuan $status
    ) {
        $this->id = $id;
        $this->mahasiswaId = $mahasiswaId;
        $this->periodeYudisiumId = $periodeYudisiumId;
        $this->status = $status;
    }

    public function getId(): AjuYudisiumId {
        return $this->id;
    }

    public function getMahasiswaId(): MahasiswaId {
        return $this->mahasiswaId;
    }

    public function getPeriodeYudisiumId(): PeriodeYudisiumId {
        return $this->periodeYudisiumId;
    }

    public function getStatus(): StatusAjuan {
        return $this->status;
    }

    public function ajukan(): void {
        if (!$this->status->isDraft() ) {
            throw new \InvalidArgumentException("Ajuan tidak dalam status draft.");
        }

        $this->status = StatusAjuan::verifying();
    }

    public function revisi(): void {
        if(!$this->status->isVerifying()) {
            throw new \InvalidArgumentException("Ajuan tidak dalam status menunggu verifikasi.");
        }

        $this->status = StatusAjuan::revised();
    }

    public function setujui(): void {
        if(!$this->status->isVerifying() && !$this->status->isRevised()) {
            throw new \InvalidArgumentException("Ajuan tidak dalam status menunggu verifikasi / revisi.");
        }

        $this->status = StatusAjuan::approved();
    }
}