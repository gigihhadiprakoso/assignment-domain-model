<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\ValueObject\SyaratYudisiumId;

class SyaratYudisium {

    private SyaratYudisiumId $id;
    private string $nama;
    private string $keterangan;

    public function __construct(
        SyaratYudisiumId $id,
        string $nama,
        string $keterangan
    ) {
        $this->id = $id;
        $this->nama = $nama;
        $this->keterangan = $keterangan;
    }

    public function getId() : SyaratYudisiumId {
        return $this->id;
    }

    public function getNama() : string {
        return $this->nama;
    }

    public function getKeterangan() : string {
        return $this->keterangan;
    }
}