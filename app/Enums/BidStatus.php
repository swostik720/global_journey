<?php

namespace App\Enums;

enum BidStatus: string
{
    case Approved = 'Approved';
    case Pending = 'Pending';
    case Applied = 'Applied';

    public static function isValid(string $value): bool
    {
        return match ($value) {
            self::Approved, self::Pending, self::Applied => true,
            default => false,
        };
    }
    public static function toSelectArray(): array
    {
        return [
            'Approved' => 'Approved',
            'Pending' => 'Pending',
            'Applied' => 'Applied',
        ];
    }
}
