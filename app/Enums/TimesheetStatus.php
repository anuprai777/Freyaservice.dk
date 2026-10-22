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
            self::SUBMITTED => __('Afventer kundegodkendelse'),
            self::APPROVED => __('Godkendt'),
            self::REJECTED => __('Afvist med begrundelse'),
        };
    }
}
