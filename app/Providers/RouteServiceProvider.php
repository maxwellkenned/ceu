<?php

<<<<<<< HEAD
namespace ceu\Providers;

use Illuminate\Support\Facades\Route;
=======
namespace App\Providers;

use Illuminate\Routing\Router;
>>>>>>> f87259c8f0a22fc60bf3c85dc0ec1809fb92c25c
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
<<<<<<< HEAD
    protected $namespace = 'ceu\Http\Controllers';
=======
    protected $namespace = 'App\Http\Controllers';
>>>>>>> f87259c8f0a22fc60bf3c85dc0ec1809fb92c25c

    /**
     * Define your route model bindings, pattern filters, etc.
     *
<<<<<<< HEAD
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
=======
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function boot(Router $router)
    {
        //

        parent::boot($router);
>>>>>>> f87259c8f0a22fc60bf3c85dc0ec1809fb92c25c
    }

    /**
     * Define the routes for the application.
     *
<<<<<<< HEAD
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();
=======
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function map(Router $router)
    {
        $this->mapWebRoutes($router);
>>>>>>> f87259c8f0a22fc60bf3c85dc0ec1809fb92c25c

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
<<<<<<< HEAD
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
=======
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    protected function mapWebRoutes(Router $router)
    {
        $router->group([
            'namespace' => $this->namespace, 'middleware' => 'web',
        ], function ($router) {
            require app_path('Http/routes.php');
        });
>>>>>>> f87259c8f0a22fc60bf3c85dc0ec1809fb92c25c
    }
}
