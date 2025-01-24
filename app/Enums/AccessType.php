<?php

namespace App\Enums;

enum AccessType: string
{
    case Tried = 'Tried';
    case Accessed = 'Accessed';
    case Failed = 'Failed';

    public static function isValid(string $value): bool
    {
        return match ($value) {
            self::Tried, self::Accessed, self::Failed => true,
            default => false,
        };
    }
    public static function toSelectArray(): array
    {
        return [
            'Tried' => 'Tried',
            'Accessed' => 'Accessed',
            'Failed' => 'Failed',
        ];
    }
}
