<?php

namespace App\Enums;

enum StaffRequestType: string
{
    case TEMPORARY_COVER = 'temporary_cover';
    case PART_TIME = 'part_time';
    case FULL_TIME = 'full_time';

    public function label(): string
    {
        return match ($this) {
            self::TEMPORARY_COVER => 'Midlertidig vikardækning',
            self::PART_TIME => 'Fast deltidspersonale',
            self::FULL_TIME => 'Fastansættelse / Fuldtid',
        };
    }
}
