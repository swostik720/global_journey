<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryCategory extends Model
{
    protected $fillable = ['title', 'description'];

    public function galleries()
    {
        return $this->hasMany(Gallery::class, 'gallery_category_id');
    }
}
