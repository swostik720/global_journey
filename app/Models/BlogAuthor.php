<?php

namespace App\Models;

use App\Traits\UploadFileTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class BlogAuthor extends Model
{
    use HasFactory;
    use UploadFileTrait;

    protected $guarded = [];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function blogs(): HasMany
    {
        return $this->hasMany(Blog::class, 'blog_author_id');
    }

    public function getProfilePicturePathAttribute(): string
    {
        return $this->profile_picture
            ? asset('uploaded-images/blog-author-images/' . $this->profile_picture)
            : 'https://upload.wikimedia.org/wikipedia/commons/a/ac/No_image_available.svg';
    }

    public function getProfileSlugAttribute(): string
    {
        return Str::slug($this->name) . '-' . $this->id;
    }

    public function getArticlesWrittenAttribute(): int
    {
        if (array_key_exists('blogs_count', $this->attributes)) {
            return (int) $this->attributes['blogs_count'];
        }

        return (int) $this->blogs()->count();
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
