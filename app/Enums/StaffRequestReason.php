<?php

namespace App\Enums;

enum StaffRequestReason: string
{
    case ABSENCE = 'absence';
    case PEAK = 'peak';
    case PERMANENT_NEED = 'permanent_need';

    public function label(): string
    {
        return match ($this) {
            self::ABSENCE => __('Sygdom / Feriefravær'),
            self::PEAK => __('Spidsbelastning / Høj sæson'),
            self::PERMANENT_NEED => __('Permanent behov / Rekruttering'),
        };
    }
}
