<?php

// namespace App\Observers;

// use App\Events\UserFollowed;
// use App\Notifications\UserFollowedNotification;

// class UserFollowedObserver
// {
//     // Handle the UserFollowed event
//     public function handle(UserFollowed $event)
//     {
//         // Get the follower and followed user from the event
//         $follower = $event->follower;
//         $followedUser = $event->followedUser;

//         // Add your notification logic here
//         $followedUser->notify(new UserFollowedNotification($follower));
//     }
// }


namespace App\Observers;

use App\Events\UserFollowed;
use App\Notifications\UserFollowedNotification;
use Illuminate\Support\Facades\Log;

class UserFollowedObserver
{
    // Handle the UserFollowed event
    public function handle(UserFollowed $event)
    {
        // Get the follower and followed user from the event
        $follower = $event->follower;
        $followedUser = $event->followedUser;

        // Log statements for debugging
        Log::info('UserFollowed event handled.');
        Log::info('Follower ID: ' . $follower->id);
        Log::info('Followed User ID: ' . $followedUser->id);

        // Add your notification logic here
        $followedUser->notify(new UserFollowedNotification($follower));
    }
}
