<?php

namespace App\Enums;

enum ShiftStatus: string
{
    case DRAFT = 'draft';
    case OPEN = 'open';
    case FILLED = 'filled';
    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';

    public function label(): string
    {
        return match ($this) {
            self::DRAFT => 'Kladde',
            self::OPEN => 'Åben for match',
            self::FILLED => 'Besat',
            self::IN_PROGRESS => 'I gang',
            self::COMPLETED => 'Fuldført',
            self::CANCELLED => 'Aflyst',
        };
    }
}
