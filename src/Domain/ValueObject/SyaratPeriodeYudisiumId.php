<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

use Ramsey\Uuid\Uuid;

class SyaratPeriodeYudisiumId
{
    private $id;

    public function __construct(string $id)
    {
        if (Uuid::isValid($id)) {
            $this->id = $id;
        } else {
            throw new \InvalidArgumentException("Invalid class SyaratPeriodeYudisiumId format.");
        }
    }

    public function id() : string
    {
        return $this->id;
    }

    public function equals(SyaratPeriodeYudisiumId $syaratPeriodeYudisiumId) : bool
    {
        return $this->id === $syaratPeriodeYudisiumId->id;
    }
}