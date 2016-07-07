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

Route::get('resource/view/{id}', 'ResourceController@view');

//if Admin is required, place route in this group
Route::group(['middleware' => 'App\Http\Middleware\AdminMiddleware'], function()
{
    Route::get('resource/create', 'ResourceController@create');
    Route::post('resource/createResource', 'ResourceController@createResource');
    Route::get('resource/edit/{id}', 'ResourceController@edit');
    Route::patch('resource/{id}', 'ResourceController@update');
    Route::get('resource/delete/{id}', 'ResourceController@delete');
    Route::delete('resource/destroy/{id}', 'ResourceController@destroy');
    Route::get('/users', 'UserController@index');
    Route::get('/resource', 'ResourceController@index');
});

//if GA is required, place route in this group
Route::group(['middleware' => 'App\Http\Middleware\GAMiddleware'], function()
{
    Route::get('resource/create', 'ResourceController@create');
    Route::post('resource/createResource', 'ResourceController@createResource');
    Route::get('resource/edit/{id}', 'ResourceController@edit');
    Route::patch('resource/{id}', 'ResourceController@update');
    Route::get('/resource', 'ResourceController@index');
});
