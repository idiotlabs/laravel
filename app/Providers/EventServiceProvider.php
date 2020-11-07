<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Routing\Events\RouteMatched;
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
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        /*
     * Changes the way inspector reports transactions in your dashboard.
     */
        Event::listen(RouteMatched::class, function(RouteMatched $event) {
            $name = $event->route->getActionName();

            if(inspector()->isRecording()) {
                inspector()->currentTransaction()->name = $name;
            } else {
                inspector()->startTransaction($name);
            }
        });
    }
}
