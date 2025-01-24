<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Traits\UploadFileTrait;

class Team extends Model
{
    use HasFactory;
    use UploadFileTrait;

    protected $guarded = [];

    public function getImagePathAttribute(): string
    {
        return $this->image ? asset('uploaded-images/team-images/' . $this->image) : 'https://upload.wikimedia.org/wikipedia/commons/a/ac/No_image_available.svg';
    }
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
