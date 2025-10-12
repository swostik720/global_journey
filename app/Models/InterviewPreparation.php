<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterviewPreparation extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'image',
        'status',
        'visa_conditions',
        'interview_questions',
        'faqs',
    ];

    protected $casts = [
        'visa_conditions' => 'array',
        'interview_questions' => 'array',
        'faqs' => 'array',
    ];
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
    public function getImagePathAttribute()
    {
        if ($this->image) {
            return asset('uploaded-images/interwiew-preperations-images/' . $this->image);
        }
        return asset('frontend/assets/img/default.jpg');
    }
}
