<?php

namespace App\Enums;

enum FileType: string
{
    case File = 'File';
    case ShortText = 'Short Text';
    case LongText = 'Long Text';
    case Checkbox = 'Checkbox';
    case Radio = 'Radio';

    public static function isValid(string $value): bool
    {
        return match ($value) {
            self::File, self::ShortText, self::LongText, self::Checkbox, self::Radio => true,
            default => false,
        };
    }
    public static function toSelectArray(): array
    {
        return [
            'File' => 'File',
            'ShortText' => 'Short Text',
            'LongText' => 'Long Text',
            'Checkbox' => 'Checkbox',
            'Radio' => 'Radio',
        ];
    }
}
