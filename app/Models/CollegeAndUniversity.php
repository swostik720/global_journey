<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CollegeAndUniversity extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_id',
        'image',
        'name',
        'description',
        'link',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function getImagePathAttribute()
    {
         if ($this->image) {
            return asset('uploaded-images/college_and_university/' . $this->image);
        }
        return asset('frontend/assets/img/default.jpg');
    }
}
