<?php

namespace App\Listeners;

use App\Events\UserAddCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyAdminOfNewUserAdd
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserAddCreated $event): void
    {
        $userAdd =$event->userAdd;
        dump('NotifyAdminOfNewUserAdd#handle',
         $userAdd->toArray());
    }
}
