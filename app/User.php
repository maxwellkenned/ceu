<?php

<<<<<<< HEAD
namespace ceu;

use Illuminate\Notifications\Notifiable;
=======
namespace App;

>>>>>>> f87259c8f0a22fc60bf3c85dc0ec1809fb92c25c
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
<<<<<<< HEAD
    use Notifiable;

=======
>>>>>>> f87259c8f0a22fc60bf3c85dc0ec1809fb92c25c
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
