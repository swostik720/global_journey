<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\UserStatus;
use App\Traits\UploadFileTrait;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable,UploadFileTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_status',
        'image',
        'email_verification_token',
        'email_verification_token_expiry',
        'user_type',
        'role_id',
        'user_status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    public function setPasswordAttribute($input): void
    {
        if ($input) {
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
        }
    }
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }

    public function hasPermissionTo($permission): bool
    {
        //        return $this->permissions->contains('slug', $permission);

        return cache()->remember('user_permissions_' . $this->id, now()->addHours(24), function () {
            return collect($this->permissions->pluck('slug'));
        })->contains($permission);
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function getImagePathAttribute(): string
    {
        return $this->image ? asset('uploaded-images/profile-images/' . $this->image) : 'https://upload.wikimedia.org/wikipedia/commons/a/ac/No_image_available.svg';
    }

}
