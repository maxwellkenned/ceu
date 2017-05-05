<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Broadcaster
    |--------------------------------------------------------------------------
    |
    | This option controls the default broadcaster that will be used by the
    | framework when an event needs to be broadcast. You may set this to
    | any of the connections defined in the "connections" array below.
    |
<<<<<<< HEAD
    | Supported: "pusher", "redis", "log", "null"
    |
    */

    'default' => env('BROADCAST_DRIVER', 'null'),
=======
    */

    'default' => env('BROADCAST_DRIVER', 'pusher'),
>>>>>>> f87259c8f0a22fc60bf3c85dc0ec1809fb92c25c

    /*
    |--------------------------------------------------------------------------
    | Broadcast Connections
    |--------------------------------------------------------------------------
    |
    | Here you may define all of the broadcast connections that will be used
    | to broadcast events to other systems or over websockets. Samples of
    | each available type of connection are provided inside this array.
    |
    */

    'connections' => [

        'pusher' => [
            'driver' => 'pusher',
<<<<<<< HEAD
            'key' => env('PUSHER_APP_KEY'),
            'secret' => env('PUSHER_APP_SECRET'),
=======
            'key' => env('PUSHER_KEY'),
            'secret' => env('PUSHER_SECRET'),
>>>>>>> f87259c8f0a22fc60bf3c85dc0ec1809fb92c25c
            'app_id' => env('PUSHER_APP_ID'),
            'options' => [
                //
            ],
        ],

        'redis' => [
            'driver' => 'redis',
            'connection' => 'default',
        ],

        'log' => [
            'driver' => 'log',
        ],

<<<<<<< HEAD
        'null' => [
            'driver' => 'null',
        ],

=======
>>>>>>> f87259c8f0a22fc60bf3c85dc0ec1809fb92c25c
    ],

];
