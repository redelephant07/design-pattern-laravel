<?php

namespace App\Events;

use App\Models\UserAdd;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserAddCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public UserAdd $userAdd;
    /**
     * Create a new event instance.
     */
    public function __construct(UserAdd $userAdd)
    {
        $this->userAdd=$userAdd;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
