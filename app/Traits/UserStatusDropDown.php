<?php

namespace App\Traits;

use App\Enums\UserStatus;

trait UserStatusDropDown
{
    public static function getStatusOptions(): array
    {
        return UserStatus::toSelectArray();
    }
    public static function isValidStatus(string $value): bool
    {
        return UserStatus::isValid($value);
    }
}
