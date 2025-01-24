<?php

namespace App\Models;

use App\Traits\UploadFileTrait;
use Illuminate\Support\Facades\Cache;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TestPreparation extends Model
{
    use HasFactory;
    use UploadFileTrait;

    protected $guarded = [];

    public function getImagePathAttribute(): string
    {
        return $this->image ? asset('uploaded-images/test-preparation-images/' . $this->image) : 'https://upload.wikimedia.org/wikipedia/commons/a/ac/No_image_available.svg';
    }
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
    protected static function booted()
    {
        static::saved(function () {
            // Clear cache whenever a testpreparations is saved (created or updated)
            Cache::forget('global_testpreparations');
            Cache::forget('global_header_footer_data');
        });

        static::deleted(function () {
            // Clear cache whenever a testpreparations is deleted
            Cache::forget('global_testpreparations');
            Cache::forget('global_header_footer_data');
        });
    }
}
