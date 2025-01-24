<?php

namespace App\Enums;

enum TenderStatus: string
{
    case Opened = 'Opened';
    case Processing = 'Processing';
    case Completed = 'Completed';
    case Closed = 'Closed';

    public static function isValid(string $value): bool
    {
        return match ($value) {
            self::Opened, self::Processing, self::Completed, self::Closed => true,
            default => false,
        };
    }
    public static function toSelectArray(): array
    {
        return [
            'Opened' => 'Opened',
            'Processing' => 'Processing',
            'Completed' => 'Completed',
            'Closed' => 'Closed',
        ];
    }
}
