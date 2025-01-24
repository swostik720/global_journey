<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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
}
