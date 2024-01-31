<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserFollowed
{
    // Traits for broadcasting events
    use Dispatchable, InteractsWithSockets, SerializesModels;

    // Public properties to store user information
    public $follower;
    public $followedUser;

    // Constructor to initialize the event with follower and followedUser
    public function __construct(User $follower, User $followedUser)
    {
        $this->follower = $follower;         // Set the follower property
        $this->followedUser = $followedUser; // Set the followedUser property
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        // Data to be broadcasted
        $data = [
            'follower' => $this->follower,         // Include follower data in the broadcast
            'followedUser' => $this->followedUser, // Include followedUser data in the broadcast
        ];

        //  debugging to inspect the data
        // dd($data);

        return $data;
    }
}
