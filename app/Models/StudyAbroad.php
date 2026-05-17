<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Traits\UploadFileTrait;

class StudyAbroad extends Model
{
    use HasFactory;
    use UploadFileTrait;

    protected $guarded = [];

    protected $casts = [
        'faqs' => 'array',
        'quick_info_items' => 'array',
        'key_highlights' => 'array',
    ];

    public function getImagePathAttribute(): string
    {
        return $this->image ? asset('uploaded-images/study-abroad-images/' . $this->image) : 'https://upload.wikimedia.org/wikipedia/commons/a/ac/No_image_available.svg';
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
    protected static function booted()
    {
        static::saved(function () {
            // Clear cache whenever a studyabroads is saved (created or updated)
            Cache::forget('global_studyabroads');
            Cache::forget('global_header_footer_data');
            Cache::forget('global_header_footer_data_v3');
        });

        static::deleted(function () {
            // Clear cache whenever a studyabroads is deleted
            Cache::forget('global_studyabroads');
            Cache::forget('global_header_footer_data');
            Cache::forget('global_header_footer_data_v3');
        });
    }
}
