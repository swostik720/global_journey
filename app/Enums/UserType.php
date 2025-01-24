<?php

namespace App\Enums;

enum UserType: string
{
    case SuperAdmin = 'Super Admin';
    case Admin = 'Admin';
    case Staff = 'Staff';
    case Reporter = 'Reporter';
    case Manager = 'Manager';

    public static function isValid(string $value): bool
    {
        return match ($value) {
            self::SuperAdmin, self::Admin, self::Staff,
            self::Reporter, self::Manager => true,
            default => false,
        };
    }
    public static function toSelectArray(): array
    {
        return [
            'SuperAdmin' => 'Super Admin',
            'Admin' => 'Admin',
            'Staff' => 'Staff',
            'Reporter' => 'Reporter',
            'Manager' => 'Manager',
        ];
    }
}
