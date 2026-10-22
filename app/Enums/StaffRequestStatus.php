<?php

namespace App\Enums;

enum StaffRequestStatus: string
{
    case NEW = 'new';
    case IN_PROGRESS = 'in_progress';
    case MATCHED = 'matched';
    case ACTIVE = 'active';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';

    public function label(): string
    {
        return match ($this) {
            self::NEW => __('Ny forespørgsel'),
            self::IN_PROGRESS => __('Under behandling'),
            self::MATCHED => __('Vikar matchet'),
            self::ACTIVE => __('Aktiv på lokation'),
            self::COMPLETED => __('Afsluttet'),
            self::CANCELLED => __('Annulleret'),
        };
    }

    public function badgeClasses(): string
    {
        return match ($this) {
            self::NEW => 'bg-action-50 text-action-700 border-action-200',
            self::IN_PROGRESS => 'bg-navy-50 text-navy-700 border-navy-100',
            self::MATCHED => 'bg-navy-100 text-navy-900 border-navy-200',
            self::ACTIVE => 'bg-forest-50 text-forest-700 border-forest-200',
            self::COMPLETED => 'bg-sand-100 text-charcoal-700 border-sand-300',
            self::CANCELLED => 'bg-brick-50 text-brick-700 border-brick-200',
        };
    }
}
