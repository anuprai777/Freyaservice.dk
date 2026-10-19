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
            self::TEMPORARY => 'Kun tilkaldevikar / Akut',
            self::PART_TIME => 'Deltid (faste dage / weekender)',
            self::FULL_TIME => 'Fuldtid / Langtidsansættelse',
            self::ANY => 'Alle typer vagter',
        };
    }
}
