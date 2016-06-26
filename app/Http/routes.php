<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/team', function () {
   return view('team'); 
});

Route::get('resource/create', 'ResourceController@create');
Route::post('resource/createResource', 'ResourceController@createResource');

Route::get('resource/delete/{id}', 'ResourceController@delete');
Route::delete('resource/destroy/{id}', 'ResourceController@destroy');

Route::get('resource/view/{id}', 'ResourceController@view');
