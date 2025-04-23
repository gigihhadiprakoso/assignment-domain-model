<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\ValueObject\PeriodeId;
use App\Domain\ValueObject\PeriodeYudisiumId;

class PeriodeYudisium {
    private PeriodeYudisiumId $id;
    private PeriodeId $periodeId;
    private string $nama;

    public function __construct(PeriodeYudisiumId $id, PeriodeId $periodeId, string $nama) {
        $this->id = $id;
        $this->periodeId = $periodeId;
        $this->nama = $nama;
    }

    public function getId(): PeriodeYudisiumId {
        return $this->id;
    }

    public function getNama(): string {
        return $this->nama;
    }

    public function getPeriodeId(): PeriodeId {
        return $this->periodeId;
    }
}