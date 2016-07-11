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

Route::get('/auth/newPassword',function(){
    return view('/auth/newPassword')->share('user', $auth->user);
});

Route::get('/team', function () {
    return view('team');
});

//resource view link doesn't redirect to login page is no one is logged in
Route::get('resource/view/{id}', 'ResourceController@view');

Route::get('/resource', 'ResourceController@index');

//if Admin is required, place route in this group
Route::group(['middleware' => 'App\Http\Middleware\AdminMiddleware'], function()
{
    //resource
    Route::get('resource/delete/{id}', 'ResourceController@delete');
    Route::delete('resource/destroy/{id}', 'ResourceController@destroy');
    Route::get('/resource', 'ResourceController@index');

    //flag
    Route::get('/flag', 'FlagController@index');
    Route::get('flag/create', 'FlagController@create');             //admin specific
    Route::post('flag/createFlag', 'FlagController@createFlag');

    //user
    Route::get('/users', 'UserController@index');
    Route::get('/user/edit/{id}', 'UserController@edit');
    Route::patch('user/{id}', 'UserController@update');
});

//if GA or Admin is required, place route in this group
Route::group(['middleware' => 'App\Http\Middleware\GAMiddleware'], function()
{
    //resource
    Route::get('resource/create', 'ResourceController@create');
    Route::post('resource/createResource', 'ResourceController@createResource');
    Route::get('resource/edit/{id}', 'ResourceController@edit');
    Route::patch('resource/{id}', 'ResourceController@update');

    //flag
    Route::get('flag/view/{id}', 'FlagController@view');
    Route::get('flag/resourceview/{id}', 'FlagController@resourceView');
    Route::get('flag/edit/{id}', 'FlagController@edit');
    Route::patch('flag/{id}', 'FlagController@update');
    Route::get('flag/delete/{id}', 'FlagController@delete');
    Route::delete('flag/destroy/{id}', 'FlagController@destroy');
});
