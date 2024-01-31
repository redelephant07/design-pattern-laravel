<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Events\UserFollowed;

class SubscribeController extends Controller
{
    // Method to subscribe a user
    public function subscribe(Request $request, $userId)
    {
        // Find the user to subscribe
        $userToSubscribe = User::findOrFail($userId);

        // Check if the user is not already subscribed
        if (!$request->user()->isSubscribed($userToSubscribe)) {
            // Subscribe the user
            $request->user()->following()->attach($userToSubscribe);

            // Increase the follower count
            $userToSubscribe->increment('follower');

            // Dispatch UserFollowed event
            // event(new UserFollowed($request->user(), $userToSubscribe));

            // Return success response


            return response()->json(['success' => true, 'followerCount' => $userToSubscribe->follower]);

        }

        // Return failure response if already subscribed
        return response()->json(['success' => false]);
    }

    // Method to unsubscribe a user
    public function unsubscribe(Request $request, $userId)
    {
        // Find the user to unsubscribe
        $userToUnsubscribe = User::findOrFail($userId);

        // Check if the user is subscribed before attempting to unsubscribe
        if ($request->user()->isSubscribed($userToUnsubscribe)) {
            // Unsubscribe the user
            $request->user()->following()->detach($userToUnsubscribe);

            // Decrease the follower count
            $userToUnsubscribe->decrement('follower');

            // Return success response
            return response()->json(['success' => true, 'followerCount' => $userToUnsubscribe->follower]);
        }

        // Return failure response if not subscribed
        return response()->json(['success' => false]);
    }
}
