<?php

namespace App\Enums;

enum TimesheetStatus: string
{
    case SUBMITTED = 'submitted';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';

    public function label(): string
    {
        return match ($this) {
            self::SUBMITTED => 'Afventer kundegodkendelse',
            self::APPROVED => 'Godkendt',
            self::REJECTED => 'Afvist med begrundelse',
        };
    }
}
