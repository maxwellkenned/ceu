<?php

<<<<<<< HEAD
namespace ceu\Providers;

use Illuminate\Support\Facades\Event;
=======
namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
>>>>>>> f87259c8f0a22fc60bf3c85dc0ec1809fb92c25c
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
<<<<<<< HEAD
        'ceu\Events\Event' => [
            'ceu\Listeners\EventListener',
=======
        'App\Events\SomeEvent' => [
            'App\Listeners\EventListener',
>>>>>>> f87259c8f0a22fc60bf3c85dc0ec1809fb92c25c
        ],
    ];

    /**
<<<<<<< HEAD
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
=======
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);
>>>>>>> f87259c8f0a22fc60bf3c85dc0ec1809fb92c25c

        //
    }
}
