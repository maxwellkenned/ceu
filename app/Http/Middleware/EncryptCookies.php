<?php

<<<<<<< HEAD
namespace ceu\Http\Middleware;
=======
namespace App\Http\Middleware;
>>>>>>> f87259c8f0a22fc60bf3c85dc0ec1809fb92c25c

use Illuminate\Cookie\Middleware\EncryptCookies as BaseEncrypter;

class EncryptCookies extends BaseEncrypter
{
    /**
     * The names of the cookies that should not be encrypted.
     *
     * @var array
     */
    protected $except = [
        //
    ];
}
