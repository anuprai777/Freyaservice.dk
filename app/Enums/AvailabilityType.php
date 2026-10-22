<?php

namespace App\Enums;

enum AvailabilityType: string
{
    case TEMPORARY = 'temporary';
    case PART_TIME = 'part_time';
    case FULL_TIME = 'full_time';
    case ANY = 'any';

    public function label(): string
    {
        return match ($this) {
            self::TEMPORARY => __('Kun tilkaldevikar / Akut'),
            self::PART_TIME => __('Deltid (faste dage / weekender)'),
            self::FULL_TIME => __('Fuldtid / Langtidsansættelse'),
            self::ANY => __('Alle typer vagter'),
        };
    }
}
