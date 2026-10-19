<?php

namespace App\Enums;

enum DocumentStatus: string
{
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';

    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'Afventer verifikation',
            self::APPROVED => 'Godkendt',
            self::REJECTED => 'Afvist',
        };
    }
}
