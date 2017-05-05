<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
<<<<<<< HEAD
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
=======
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
>>>>>>> f87259c8f0a22fc60bf3c85dc0ec1809fb92c25c
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
<<<<<<< HEAD
        'model' => ceu\User::class,
=======
        'model' => App\User::class,
>>>>>>> f87259c8f0a22fc60bf3c85dc0ec1809fb92c25c
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

];
