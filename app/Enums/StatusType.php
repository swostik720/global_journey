<?php

namespace App\Enums;

enum StatusType: string
{
    case Active = 'Active';
    case Inactive = 'Inactive';
    case Closed = 'Closed';

    public static function isValid(string $value): bool
    {
        return match ($value) {
            self::Active, self::Inactive, self::Closed => true,
            default => false,
        };
    }
    public static function toSelectArray(): array
    {
        return [
            'Active' => 'Active',
            'Inactive' => 'Inactive',
            'Closed' => 'Closed',
        ];
    }
}
