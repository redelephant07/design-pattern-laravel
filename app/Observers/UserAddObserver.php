<?php

namespace App\Observers;

use App\Models\UserAdd;

class UserAddObserver
{
    /**
     * Handle the UserAdd "created" event.
     */
    public function created(UserAdd $userAdd): void

        {
            dump('UserAddObserver#created',$userAdd->toArray());
        }


    /**
     * Handle the UserAdd "updated" event.
     */
    public function updated(UserAdd $userAdd): void

        {
            dump('UserUpdateObserver#created',$userAdd->toArray());
        }


    /**
     * Handle the UserAdd "deleted" event.
     */
    public function deleted(UserAdd $userAdd): void
    {
        dump('UserdeleteObserver#created',$userAdd->toArray());
    }

    /**
     * Handle the UserAdd "restored" event.
     */
    public function restored(UserAdd $userAdd): void
    {
        //
    }

    /**
     * Handle the UserAdd "force deleted" event.
     */
    public function forceDeleted(UserAdd $userAdd): void
    {
        //
    }
}
