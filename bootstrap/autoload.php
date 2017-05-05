<?php

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Register The Composer Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader
| for our application. We just need to utilize it! We'll require it
<<<<<<< HEAD
| into the script here so we do not have to manually load any of
| our application's PHP classes. It just feels great to relax.
=======
| into the script here so that we do not have to worry about the
| loading of any our classes "manually". Feels great to relax.
>>>>>>> f87259c8f0a22fc60bf3c85dc0ec1809fb92c25c
|
*/

require __DIR__.'/../vendor/autoload.php';
<<<<<<< HEAD
=======

/*
|--------------------------------------------------------------------------
| Include The Compiled Class File
|--------------------------------------------------------------------------
|
| To dramatically increase your application's performance, you may use a
| compiled class file which contains all of the classes commonly used
| by a request. The Artisan "optimize" is used to create this file.
|
*/

$compiledPath = __DIR__.'/cache/compiled.php';

if (file_exists($compiledPath)) {
    require $compiledPath;
}
>>>>>>> f87259c8f0a22fc60bf3c85dc0ec1809fb92c25c
