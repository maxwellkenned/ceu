<?php

<<<<<<< HEAD
namespace ceu\Http\Controllers;
=======
namespace App\Http\Controllers;
>>>>>>> f87259c8f0a22fc60bf3c85dc0ec1809fb92c25c

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
<<<<<<< HEAD

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
=======
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;
>>>>>>> f87259c8f0a22fc60bf3c85dc0ec1809fb92c25c
}
