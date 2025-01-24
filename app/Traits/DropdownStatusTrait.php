<?php

namespace App\Traits;
use App\Enums\StatusType;

trait DropdownStatusTrait
{
    public static function getStatusOptions(): array
    {
        return StatusType::toSelectArray();
    }
    public static function isValidStatus(string $value): bool
    {
        return StatusType::isValid($value);
    }

    public function updateDropdownStatus(string $modelName, int $id, string $status): bool
    {
        if (!StatusType::isValid($status)) {
            return false;
        }

        $model = "App\\Models\\" . $modelName;
        $value = $model::findOrFail($id);
        $value->status = $status;
        $value->save();

        return true;
    }
}
