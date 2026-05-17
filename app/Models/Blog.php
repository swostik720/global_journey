<?php

namespace App\Models;

use App\Traits\UploadFileTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Cache;

class Blog extends Model
{
    use HasFactory;
    use UploadFileTrait;

    protected $guarded = [];

    protected $casts = [
        'faqs' => 'array',
        'quick_info_items' => 'array',
        'key_highlights' => 'array',
        'open_count' => 'integer',
    ];

    public function getImagePathAttribute(): string
    {
        return $this->image ? asset('uploaded-images/blog-images/' . $this->image) : 'https://upload.wikimedia.org/wikipedia/commons/a/ac/No_image_available.svg';
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(BlogAuthor::class, 'blog_author_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    protected static function booted()
    {
        static::saved(function () {
            // Clear cache whenever a blog is saved (created or updated)
            Cache::forget('sitemap_xml');
        });

        static::deleted(function () {
            // Clear cache whenever a blog is deleted
            Cache::forget('sitemap_xml');
        });
    }
}
