<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

use Ramsey\Uuid\Uuid;

class AjuYudisiumId
{
    private $id;

    public function __construct(string $id)
    {
        if (Uuid::isValid($id)) {
            $this->id = $id;
        } else {
            throw new \InvalidArgumentException("Invalid class AjuYudisiumId format.");
        }
    }

    public function id() : string
    {
        return $this->id;
    }

    public function equals(AjuYudisiumId $ajuYudisiumId) : bool
    {
        return $this->id === $ajuYudisiumId->id;
    }
}