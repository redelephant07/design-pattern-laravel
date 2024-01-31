<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    // Include the HasFactory trait for Eloquent models
    use HasFactory;

    // Define the columns that can be mass-assigned
    protected $fillable = [
        'user_id',
        'follower_id',
    ];

    // Define a relationship: a Follower belongs to a User (the followed user)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Define a relationship: a Follower belongs to another User (the follower)
    public function follower()
    {
        return $this->belongsTo(User::class, 'follower_id');
    }
}
