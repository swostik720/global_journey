<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LegalPage extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'title' => 'array',
        'description' => 'array',
    ];

    public function getTitleTextAttribute(): string
    {
        return (string) ($this->title['en'] ?? '');
    }

    public function getDescriptionHtmlAttribute(): string
    {
        return (string) ($this->description['en'] ?? '');
    }
}
