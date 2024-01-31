<?php
// User.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'follower',
        'totalfollower',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function isSubscribed(User $userToCheck): bool
    {
        return $this->following()->where('follower_id', $userToCheck->id)->exists();
    }

    public function followers(): BelongsToMany
    {
        // Assuming you have a Follower model with 'user_id' and 'follower_id' columns
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');
    }

    public function following(): BelongsToMany
    {
        // Assuming you have a Follower model with 'user_id' and 'follower_id' columns
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }
}
