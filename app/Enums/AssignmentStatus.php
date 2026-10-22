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
            self::OFFERED => __('Tilbudt vikar'),
            self::ACCEPTED => __('Accepteret'),
            self::DECLINED => __('Afvist'),
            self::ACTIVE => __('Aktiv på vagt'),
            self::COMPLETED => __('Gennemført'),
            self::CANCELLED => __('Annulleret'),
        };
    }
}
