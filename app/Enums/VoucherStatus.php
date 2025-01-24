<?php

namespace App\Enums;

enum VoucherStatus: string
{
    case Approved = 'Approved';
    case Pending = 'Pending';
    case Applied = 'Applied';
    case Declined = 'Declined';

    public static function isValid(string $value): bool
    {
        return match ($value) {
            self::Approved, self::Pending, self::Applied, self::Declined => true,
            default => false,
        };
    }
    public static function toSelectArray(): array
    {
        return [
            'Approved' => 'Approved',
            'Pending' => 'Pending',
            'Applied' => 'Applied',
            'Declined' => 'Declined',
        ];
    }
}
