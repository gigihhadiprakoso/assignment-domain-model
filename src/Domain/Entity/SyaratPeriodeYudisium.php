<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\ValueObject\PeriodeYudisiumId;
use App\Domain\ValueObject\SyaratPeriodeYudisiumId;
use App\Domain\ValueObject\SyaratYudisiumId;

class SyaratPeriodeYudisium
{
    private SyaratPeriodeYudisiumId $id;
    private PeriodeYudisiumId $periodeYudisiumId;
    private SyaratYudisiumId $syaratYudisiumId;
    private bool $isUpload;
    private bool $isMandatory;

    public function __construct(
        SyaratPeriodeYudisiumId $id,
        PeriodeYudisiumId $periodeYudisiumId,
        SyaratYudisiumId $syaratYudisiumId,
        bool $isUpload,
        bool $isMandatory
    )
    {
        $this->id = $id;
        $this->periodeYudisiumId = $periodeYudisiumId;
        $this->syaratYudisiumId = $syaratYudisiumId;
        $this->isUpload = $isUpload;
        $this->isMandatory = $isMandatory;
    }

    public function getId() : SyaratPeriodeYudisiumId
    {
        return $this->id;
    }

    public function getPeriodeYudisiumId() : PeriodeYudisiumId
    {
        return $this->periodeYudisiumId;
    }

    public function getSyaratYudisiumId() : SyaratYudisiumId
    {
        return $this->syaratYudisiumId;
    }
    
    public function isUpload() : bool {
        return $this->isUpload;
    }

    public function isMandatory() : bool {
        return $this->isMandatory;
    }
}