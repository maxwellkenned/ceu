<?php

<<<<<<< HEAD
namespace ceu\Providers;

use Illuminate\Support\Facades\Gate;
=======
namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
>>>>>>> f87259c8f0a22fc60bf3c85dc0ec1809fb92c25c
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
<<<<<<< HEAD
        'ceu\Model' => 'ceu\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
=======
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);
>>>>>>> f87259c8f0a22fc60bf3c85dc0ec1809fb92c25c

        //
    }
}
