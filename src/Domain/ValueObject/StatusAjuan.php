<?php 

declare(strict_types=1);

namespace App\Domain\ValueObject;

use Google\Service\Gmail\Draft;
use Status;

class StatusAjuan
{
    const DRAFT = 'D';
    const VERIFYING = 'V';
    const REVISED = 'R';
    const APPROVED = 'A';

    private string $status;

    public function __construct(string $status)
    {
        if(!in_array($status, [self::DRAFT, self::VERIFYING, self::REVISED, self::APPROVED])) {
            throw new \InvalidArgumentException("Status not valid. Allowed values are: " . implode(", ", [self::DRAFT, self::VERIFYING, self::REVISED, self::APPROVED]));
        }
        $this->status = $status;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function equals(StatusAjuan $statusAjuan): bool
    {
        return $this->status === $statusAjuan->getStatus();
    }

    public function isDraft(): bool
    {
        return $this->status === self::DRAFT;
    }

    public function isVerifying(): bool
    {
        return $this->status === self::VERIFYING;
    }

    public function isRevised(): bool
    {
        return $this->status === self::REVISED;
    }

    public function isApproved(): bool
    {
        return $this->status === self::APPROVED;
    }
     
    public static function draft(): StatusAjuan
    {
        return new StatusAjuan(self::DRAFT);
    }

    public static function verifying(): StatusAjuan
    {
        return new StatusAjuan(self::VERIFYING);
    }

    public static function revised(): StatusAjuan
    {
        return new StatusAjuan(self::REVISED);
    }

    public static function approved(): StatusAjuan
    {
        return new StatusAjuan(self::APPROVED);
    }

}