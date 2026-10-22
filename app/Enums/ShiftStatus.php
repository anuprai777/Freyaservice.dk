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
            self::DRAFT => __('Kladde'),
            self::OPEN => __('Åben for match'),
            self::FILLED => __('Besat'),
            self::IN_PROGRESS => __('I gang'),
            self::COMPLETED => __('Fuldført'),
            self::CANCELLED => __('Aflyst'),
        };
    }
}
