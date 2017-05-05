<?php

<<<<<<< HEAD
namespace ceu\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
=======
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
>>>>>>> f87259c8f0a22fc60bf3c85dc0ec1809fb92c25c

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
<<<<<<< HEAD
        Schema::defaultStringLength(191);
=======
        //
>>>>>>> f87259c8f0a22fc60bf3c85dc0ec1809fb92c25c
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
