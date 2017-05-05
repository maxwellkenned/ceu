<?php

<<<<<<< HEAD
namespace ceu\Http\Middleware;
=======
namespace App\Http\Middleware;
>>>>>>> f87259c8f0a22fc60bf3c85dc0ec1809fb92c25c

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
    ];
}
