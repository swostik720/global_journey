<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DocumentChecklist extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_id',
        'documents',
    ];

    protected $casts = [
        'documents' => 'array',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
