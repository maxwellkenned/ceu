<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/upload', 'ArquivoController@upload');

Route::get("/d/{file?}", 'ArquivoController@download')->where('file', '.+');

Route::get('tree', ['uses' => 'TreeController@index',]);

Route::get('tree/data', ['as' => 'tree.data', 'uses' => 'TreeController@data', ]);
