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
            self::NEW => 'Ny forespørgsel',
            self::IN_PROGRESS => 'Under behandling',
            self::MATCHED => 'Vikar matchet',
            self::ACTIVE => 'Aktiv på lokation',
            self::COMPLETED => 'Afsluttet',
            self::CANCELLED => 'Annulleret',
        };
    }

    public function badgeClasses(): string
    {
        return match ($this) {
            self::NEW => 'bg-amber-100 text-amber-800 border-amber-200',
            self::IN_PROGRESS => 'bg-blue-100 text-blue-800 border-blue-200',
            self::MATCHED => 'bg-indigo-100 text-indigo-800 border-indigo-200',
            self::ACTIVE => 'bg-emerald-100 text-emerald-800 border-emerald-200',
            self::COMPLETED => 'bg-slate-100 text-slate-800 border-slate-200',
            self::CANCELLED => 'bg-rose-100 text-rose-800 border-rose-200',
        };
    }
}
