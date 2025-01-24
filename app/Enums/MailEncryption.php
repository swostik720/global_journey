<?php

namespace App\Enums;

enum MailEncryption: string
{
    const TLS = 'tls';
    const SSL = 'ssl';

    public static function values(): array
    {
        return [
            self::TLS,
            self::SSL,
        ];
    }
}
