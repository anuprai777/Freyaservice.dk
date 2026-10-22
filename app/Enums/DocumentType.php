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
            self::WORK_PERMIT => __('Arbejdstilladelse'),
            self::CERTIFICATE => __('Certifikat / Hygiejnebevis / Kørekort'),
            self::ID => __('Legitimation / Pas / Opholdskort'),
            self::CONTRACT => __('Underskrevet ansættelseskontrakt'),
        };
    }
}
