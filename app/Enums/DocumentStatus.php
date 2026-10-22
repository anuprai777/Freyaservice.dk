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
            self::PENDING => __('Afventer verifikation'),
            self::APPROVED => __('Godkendt'),
            self::REJECTED => __('Afvist'),
        };
    }
}
