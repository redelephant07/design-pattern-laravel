<?php

namespace App\Providers;

use App\Events\UserFollowed;
use App\Events\UserSubscribed;
use App\Listeners\SendSubscriptionNotification;
use App\Observers\UserFollowedObserver;
use App\Observers\UserSubscribedObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Models\Invoice;
use App\Observers\InvoiceObserver;
use App\Models\User;
use App\Observers\UserObserver;
use App\Events\InvoiceCreated;
use App\Events\UserAddCreated;
use App\Listeners\NotifyAdminOfNewInvoice;
use App\Listeners\NotifyAdminOfNewUserAdd;
use App\Listeners\NotifyCustomerOfNewInvoice;

class EventServiceProvider extends ServiceProvider
{
    // Define the events and their listeners
    protected $listen = [
        // Event: UserFollowed
        // Listener: UserFollowedObserver
        UserFollowed::class => [
            UserFollowedObserver::class,
        ],

        // Event: Registered
        // Listener: SendEmailVerificationNotification
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        // Event: InvoiceCreated
        // Listeners: NotifyCustomerOfNewInvoice, NotifyAdminOfNewInvoice
        InvoiceCreated::class => [
            NotifyCustomerOfNewInvoice::class,
            NotifyAdminOfNewInvoice::class,
        ],

        // Event: UserAddCreated
        // Listener: NotifyAdminOfNewUserAdd
        UserAddCreated::class => [
            NotifyAdminOfNewUserAdd::class,
        ],
    ];

    // Bootstrap any application services
    public function boot(): void
    {
        // Observe the Invoice and User models
        Invoice::observe(InvoiceObserver::class);
        User::observe(UserObserver::class);
    }

    // Determine if events and listeners should be discovered automatically
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
