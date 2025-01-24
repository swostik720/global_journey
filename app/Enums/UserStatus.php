<?php

namespace App\Enums;

enum UserStatus: string
{
    case Active = 'Active';
    case Inactive = 'Inactive';
    case Suspended = 'Suspended';
    case Blacklist = 'Blacklist';
    case PendingVerification = 'Pending Verification';

    public static function isValid(string $value): bool
    {
        
        // return match ($value) {
        //     self::Active, self::Inactive, self::Suspended,
        //     self::Blacklist, self::PendingVerification => true,
        //     default => false,
        // };

        foreach(self::cases() as $case){
            if($case->value == $value){
                return true;
            }
        }
        return false;
    }
    //this toSelectArray is for the status changed in the datatable as like an dropdown and auto update the status
    public static function toSelectArray(): array
    {
        return [
            'Active' => 'Active',
            'Inactive' => 'Inactive',
            'Suspended' => 'Suspended',
            'Blacklist' => 'Blacklist',
            'PendingVerification' => 'Pending Verification',
        ];
    }
}
