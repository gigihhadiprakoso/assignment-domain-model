<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

use Ramsey\Uuid\Uuid;

class PeriodeYudisiumId
{
    private $id;

    public function __construct(string $id)
    {
        if (Uuid::isValid($id)) {
            $this->id = $id;
        } else {
            throw new \InvalidArgumentException("Invalid class PeriodeYudisiumId format.");
        }
    }

    public function id() : string
    {
        return $this->id;
    }

    public function equals(PeriodeYudisiumId $periodeYudisiumId) : bool
    {
        return $this->id === $periodeYudisiumId->id;
    }
}