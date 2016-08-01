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
    return view('/auth/newPassword')->with('user', Auth::user())->with('errors',null);
});
Route::patch('auth/newPassword', 'NewPassController@updatePass');

Route::get('/team', function () {
    return view('team');
});

//resource view link doesn't redirect to login page is no one is logged in
Route::get('resource/view/{resource}', 'ResourceController@view');

Route::get('/resource', 'ResourceController@index');
Route::get('/resource/generateReport', 'ResourceController@generateReport');
Route::get('/resource/generatePDF', 'ResourceController@generatePDF');
Route::get('resource/view/{resource}', 'ResourceController@view');

//if Admin is required, place route in this group
Route::group(['middleware' => 'App\Http\Middleware\AdminMiddleware'], function()
{
    //category
    //Route::get('category/create', 'CategoryController@create');
    //Route::post('category/store', 'CategoryController@store');
    //Route::get('category/edit/{category}', 'CategoryController@edit');
    //Route::patch('category/{category}', 'CategoryController@update');
    Route::get('category/view/{category}', 'CategoryController@view');
    
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
    //category
    Route::get('/category', 'CategoryController@index');
    Route::get('category/create', 'CategoryController@create');
    Route::post('category/store', 'CategoryController@store');
    Route::get('category/edit/{category}', 'CategoryController@edit');
    Route::patch('category/{category}', 'CategoryController@update');
    Route::get('category/view/{category}', 'CategoryController@view');

    //resource
    Route::get('/resource/generateReport', 'ResourceController@generateReport');
    Route::get('/resource', 'ResourceController@index');
    Route::get('/resource/generatePDF', 'ResourceController@generatePDF');
    Route::get('resource/create', 'ResourceController@create');
    Route::post('resource/createResource', 'ResourceController@createResource');
    Route::get('resource/edit/{id}', 'ResourceController@edit');
    Route::patch('resource/{id}', 'ResourceController@update');
    Route::get('resource/add/{id}', 'ResourceController@add');

    //flag
    Route::get('flag/view/{id}', 'FlagController@view');
    Route::get('flag/resourceview/{id}', 'FlagController@resourceView');
    Route::get('flag/edit/{id}', 'FlagController@edit');
    Route::patch('flag/{id}', 'FlagController@update');
    Route::get('flag/delete/{id}', 'FlagController@delete');
    Route::delete('flag/destroy/{id}', 'FlagController@destroy');

    //contact
    Route::get('/contact/edit/{id}', 'ContactController@edit');
    Route::patch('/contact/{id}', 'ContactController@update');
    Route::get('/contact/view/{id}', 'ContactController@view');
    Route::get('/contact', 'ContactController@index');
    Route::get('contact/create', 'ContactController@create');
    Route::post('contact/createContact', 'ContactController@createContact');
    Route::get('contact/delete/{id}', 'ContactController@delete');
    Route::delete('contact/destroy/{id}', 'ContactController@destroy');
});
