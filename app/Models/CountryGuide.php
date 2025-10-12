<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CountryGuide extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_id',
        'guides',
    ];

    protected $casts = [
        'guides' => 'array',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
