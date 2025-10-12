<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnrollNow extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'test_preparation_id',
        'branch_id'
    ];

    public function testPreparation()
    {
        return $this->belongsTo(TestPreparation::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
