<?php

namespace App\Enums;

enum WorkerStatus: string
{
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case SUSPENDED = 'suspended';
    case BLOCKED = 'blocked';

    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'Afventer godkendelse',
            self::APPROVED => 'Godkendt og aktiv',
            self::SUSPENDED => 'Suspenderet',
            self::BLOCKED => 'Blokeret',
        };
    }
}
