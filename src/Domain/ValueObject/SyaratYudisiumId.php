<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

use Ramsey\Uuid\Uuid;

class SyaratYudisiumId
{
    private $id;

    public function __construct(string $id)
    {
        if (Uuid::isValid($id)) {
            $this->id = $id;
        } else {
            throw new \InvalidArgumentException("Invalid class SyaratYudisiumId format.");
        }
    }

    public function id() : string
    {
        return $this->id;
    }

    public function equals(SyaratYudisiumId $syaratYudisiumId) : bool
    {
        return $this->id === $syaratYudisiumId->id;
    }
}