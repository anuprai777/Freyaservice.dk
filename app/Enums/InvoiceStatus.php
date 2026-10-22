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
            self::DRAFT => __('Kladde'),
            self::SENT => __('Afsendt'),
            self::PAID => __('Betalt'),
            self::OVERDUE => __('Forfalden'),
            self::CANCELLED => __('Krediteret / Annulleret'),
        };
    }
}
