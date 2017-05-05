<?php

<<<<<<< HEAD
namespace ceu\Http\Middleware;
=======
namespace App\Http\Middleware;
>>>>>>> f87259c8f0a22fc60bf3c85dc0ec1809fb92c25c

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
<<<<<<< HEAD
            return redirect('/home');
=======
            return redirect('/');
>>>>>>> f87259c8f0a22fc60bf3c85dc0ec1809fb92c25c
        }

        return $next($request);
    }
}
