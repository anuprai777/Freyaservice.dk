<?php

namespace App\Enums;

enum InvoiceStatus: string
{
    case DRAFT = 'draft';
    case SENT = 'sent';
    case PAID = 'paid';
    case OVERDUE = 'overdue';
    case CANCELLED = 'cancelled';

    public function label(): string
    {
        return match ($this) {
            self::DRAFT => 'Kladde',
            self::SENT => 'Afsendt',
            self::PAID => 'Betalt',
            self::OVERDUE => 'Forfalden',
            self::CANCELLED => 'Krediteret / Annulleret',
        };
    }
}
