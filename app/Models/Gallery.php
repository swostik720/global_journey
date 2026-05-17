<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Gallery extends Model
{
    protected $fillable = ['gallery_category_id', 'title', 'images', 'status'];

    /**
     * Cast images column to array automatically.
     */
    protected $casts = [
        'images' => 'array',
    ];

    /**
     * A gallery belongs to a category.
     */
    public function galleryCategory()
    {
        return $this->belongsTo(GalleryCategory::class, 'gallery_category_id');
    }

    /**
     * Get full URLs for all images.
     */
    public function getImagesPathAttribute(): array
    {
        $paths = [];
        if ($this->images && is_array($this->images)) {
            foreach ($this->images as $image) {
                $paths[] = asset('uploaded-images/gallery/' . $image);
            }
        }
        return $paths;
    }

    /**
     * Scope to get active galleries.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    /**
     * Add new images to the gallery.
     */
    public function addImages(array $newImages)
    {
        $existing = $this->images ?? [];
        $this->images = array_merge($existing, $newImages);
        $this->save();
    }

    /**
     * Remove an image from the gallery.
     */
    public function removeImage(string $image)
    {
        $images = $this->images ?? [];
        $this->images = array_values(array_filter($images, fn($img) => $img !== $image));
        $this->save();
    }

    protected static function booted()
    {
        static::saved(function () {
            // Clear cache whenever a gallery is saved (created or updated)
            Cache::forget('sitemap_xml');
        });

        static::deleted(function () {
            // Clear cache whenever a gallery is deleted
            Cache::forget('sitemap_xml');
        });
    }
}
