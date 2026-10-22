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
            self::PENDING => __('Afventer godkendelse'),
            self::APPROVED => __('Godkendt og aktiv'),
            self::SUSPENDED => __('Suspenderet'),
            self::BLOCKED => __('Blokeret'),
        };
    }
}
