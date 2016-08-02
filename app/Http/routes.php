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
/*Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController'
]);*/

//Route::resource('resources', 'ResourcesController');
Route::get('resources', 'ResourcesController@index');
Route::get('resources/create', 'ResourcesController@create');
Route::get('resources/{resource}', 'ResourcesController@show');
Route::post('resources', 'ResourcesController@store');
Route::get('resources/{resource}/edit', 'ResourcesController@edit');
Route::patch('resources/{resource}', 'ResourcesController@update');
Route::delete('resources/{resource}', 'ResourcesController@destroy');

Route::get('contacts', 'ContactsController@index');
Route::get('contacts/create', 'ContactsController@create');
Route::get('contacts/{contact}', 'ContactsController@show');
Route::get('contacts/{contact}/edit', 'ContactsController@edit');
Route::post('contacts', 'ContactsController@store');
Route::patch('contacts/{contact}', 'ContactsController@update');
Route::delete('contacts/{contact}', 'ContactsController@destroy');
