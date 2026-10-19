<?php

namespace App\Enums;

enum AssignmentStatus: string
{
    case OFFERED = 'offered';
    case ACCEPTED = 'accepted';
    case DECLINED = 'declined';
    case ACTIVE = 'active';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';

    public function label(): string
    {
        return match ($this) {
            self::OFFERED => 'Tilbudt vikar',
            self::ACCEPTED => 'Accepteret',
            self::DECLINED => 'Afvist',
            self::ACTIVE => 'Aktiv på vagt',
            self::COMPLETED => 'Gennemført',
            self::CANCELLED => 'Annulleret',
        };
    }
}
