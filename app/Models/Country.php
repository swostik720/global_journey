<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function studyabroads()
    {
        return $this->hasMany(StudyAbroad::class, 'country_id', 'id');
    }
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    protected static function booted()
    {
        static::saved(function () {
            Cache::forget('global_header_footer_data');
            Cache::forget('global_header_footer_data_v3');
        });

        static::deleted(function () {
            Cache::forget('global_header_footer_data');
            Cache::forget('global_header_footer_data_v3');
        });
    }
}
