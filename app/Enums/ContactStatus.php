<?php

namespace App\Enums;

enum ContactStatus: string
{
    case Requested = 'Requested';
    case Contacted = 'Contacted';
    case Rejected = 'Rejected';

    public static function isValid(string $value): bool
    {
        return match ($value) {
            self::Requested, self::Contacted, self::Rejected => true,
            default => false,
        };
    }
    public static function toSelectArray(): array
    {
        return [
            'Requested' => 'Requested',
            'Contacted' => 'Contacted',
            'Rejected' => 'Rejected',
        ];
    }
}
