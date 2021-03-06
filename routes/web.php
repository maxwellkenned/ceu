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

Route::get('/info', function(){
    return phpinfo();
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/upload', 'ArquivoController@upload');

Route::post("/download/{id?}", ['as' => 'download', 'uses' => 'ArquivoController@download'])->where('id', '.+');

Route::post("/delete/{id?}", ['as' => 'delete', 'uses' => 'ArquivoController@delete'])->where('id', '.+');

Route::get("/path/{uri?}", ['as' =>'readFolder', 'uses' =>'ArquivoController@getFiles',])->where('uri', '.+');

Route::post('/createFolder', ['as' => 'createFolder', 'uses' => 'ArquivoController@createFolder',]);

Route::get('tree', ['uses' => 'TreeController@index',]);

Route::get('tree/data', ['as' => 'tree.data', 'uses' => 'TreeController@data', ]);

Route::get("user/{id?}/path/{uri?}", ['as' =>'perfil', 'uses' =>'ArquivoController@perfil',])->where(['id'=> '[0-9]+', 'uri' => '.+']);

Route::get("user/{id?}/path/{uri?}", ['as' =>'perfilRead', 'uses' =>'ArquivoController@perfil',])->where(['id'=> '[0-9]+', 'uri' => '.+']);

Route::Post('useronline', ['as' => 'useronline', 'uses' => "HomeController@online"]);
Route::Post('useroffline', ['as' => 'useroffline', 'uses' => "HomeController@offline"]);

Route::Post('submitmsg', ['as' => 'submitmsg', 'uses' => 'ChatController@submit']);
Route::Post('historicomsg', ['as' => 'historicomsg', 'uses' => 'ChatController@historico']);
Route::Post('lermsg', ['as' => 'lermsg', 'uses' => 'ChatController@lermsg']);
Route::get('stream', ['as' => 'stream', 'uses' => 'ChatController@stream']);
