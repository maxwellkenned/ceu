<?php

<<<<<<< HEAD
namespace ceu\Http;
=======
namespace App\Http;
>>>>>>> f87259c8f0a22fc60bf3c85dc0ec1809fb92c25c

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
<<<<<<< HEAD
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \ceu\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
=======
>>>>>>> f87259c8f0a22fc60bf3c85dc0ec1809fb92c25c
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
<<<<<<< HEAD
            \ceu\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \ceu\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
=======
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
>>>>>>> f87259c8f0a22fc60bf3c85dc0ec1809fb92c25c
        ],

        'api' => [
            'throttle:60,1',
<<<<<<< HEAD
            'bindings',
=======
>>>>>>> f87259c8f0a22fc60bf3c85dc0ec1809fb92c25c
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
<<<<<<< HEAD
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \ceu\Http\Middleware\RedirectIfAuthenticated::class,
=======
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'can' => \Illuminate\Foundation\Http\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
>>>>>>> f87259c8f0a22fc60bf3c85dc0ec1809fb92c25c
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
    ];
}
