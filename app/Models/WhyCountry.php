<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhyCountry extends Model
{
    use HasFactory;

    protected $table = 'why_countries';

    protected $fillable = [
        'country_id',
        'description',
    ];

    // Automatically cast description to array
    protected $casts = [
        'description' => 'array',
    ];

    // Relationship with Country
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
