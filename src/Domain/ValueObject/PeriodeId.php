<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

class PeriodeId
{
    private $id;

    public function __construct(string $id)
    {
        if (strlen($id) == 5 && preg_match('/^[0-9]{5}$/', $id)) {
            $this->id = $id;
        } else {
            throw new \InvalidArgumentException("Invalid class PeriodeId format.");
        }
    }

    public function id() : string
    {
        return $this->id;
    }

    public function equals(PeriodeId $periodeId) : bool
    {
        return $this->id === $periodeId->id;
    }
}