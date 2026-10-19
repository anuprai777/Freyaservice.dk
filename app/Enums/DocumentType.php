<?php

namespace App\Enums;

enum DocumentType: string
{
    case WORK_PERMIT = 'work_permit';
    case CERTIFICATE = 'certificate';
    case ID = 'id';
    case CONTRACT = 'contract';

    public function label(): string
    {
        return match ($this) {
            self::WORK_PERMIT => 'Arbejdstilladelse',
            self::CERTIFICATE => 'Certifikat / Hygiejnebevis / Kørekort',
            self::ID => 'Legitimation / Pas / Opholdskort',
            self::CONTRACT => 'Underskrevet ansættelseskontrakt',
        };
    }
}
