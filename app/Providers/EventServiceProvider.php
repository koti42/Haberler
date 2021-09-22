<?php

namespace App\Providers;

use App\Events\TwoFactoryUsers;
use App\Events\UsersAdded;
use App\Listeners\SendUsersMail;
use App\Listeners\TwoFactoryUsersListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        UsersAdded::class=>[
            SendUsersMail::class,
        ],
        TwoFactoryUsers::class=>[
            TwoFactoryUsersListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
