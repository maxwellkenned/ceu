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
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/', 'FileController@getFiles');
    Route::post('/u', 'FileController@upload');
    Route::get("/d/{file?}", 'FileController@download')->where('file', '.+');
    Auth::routes();
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('fileentry', 'FileEntryController@index');
    Route::get('fileentry/get/{filename}', ['as' => 'getentry', 'uses' => 'FileEntryController@get']);
    Route::post('fileentry/add',['as' => 'addentry', 'uses' => 'FileEntryController@add']);
