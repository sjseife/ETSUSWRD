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
    if(Auth::guest())
    {
        return redirect(url('/login'));
    }
});
/*Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController'
]);*/


//if Admin is required, place route in this group
Route::group(['middleware' => 'App\Http\Middleware\AdminAccessMiddleware'], function()
{
    //resource
    Route::delete('resources/{resource}', 'ResourcesController@destroy');\

    //user
    Route::get('users', 'UsersController@index');
    Route::get('users/create', 'UsersController@create');
    Route::get('users/{user}', 'UsersController@show');
    Route::get('users/{user}/edit', 'UsersController@edit');
    Route::get('users/{user}/flag', 'UsersController@flag');
    Route::post('users/flag/{user}', 'UsersController@storeFlag');
    Route::post('users', 'UsersController@store');
    Route::patch('users/{user}', 'UsersController@update');
    Route::delete('users/{user}', 'UsersController@destroy');

});

//if GA or Admin is required, place route in this group
Route::group(['middleware' => 'App\Http\Middleware\GAAccessMiddleware'], function()
{
    //resource
    Route::get('resources/create', 'ResourcesController@create');//resource creation form
    Route::post('resources', 'ResourcesController@store');//save a new resource
    Route::get('resources/{resource}/edit', 'ResourcesController@edit');//resource edit form
    Route::patch('resources/{resource}', 'ResourcesController@update');//resource edit save

    //contacts
    Route::get('contacts', 'ContactsController@index');
    Route::get('contacts/create', 'ContactsController@create');
    Route::get('contacts/{contact}', 'ContactsController@show');
    Route::get('contacts/{contact}/edit', 'ContactsController@edit');
    Route::get('contacts/{contact}/flag', 'contactsController@flag');
    Route::post('contacts/flag/{contact}', 'contactsController@storeFlag');
    Route::post('contactsJSON', 'ContactsController@storeJSON');
    Route::post('contacts', 'ContactsController@store');
    Route::patch('contacts/{contact}', 'ContactsController@update');
    Route::delete('contacts/{contact}', 'ContactsController@destroy');

    //categories
    Route::get('categories', 'CategoryController@index');
    Route::get('categories/create', 'CategoryController@create');
    Route::get('categories/{category}', 'CategoryController@show');
    Route::get('categories/{category}/edit', 'CategoryController@edit');
    Route::post('categories', 'CategoryController@store');
    Route::patch('categories/{category}', 'CategoryController@update');
    Route::delete('categories/{category}', 'CategoryController@destroy');
});

//if gerneral user is required, leave it below.

//resource
Route::get('resources', 'ResourcesController@index');
Route::get('resources/add/{resource}', 'ResourcesController@add'); //add resource to report
Route::get('resources/generateReport', 'ResourcesController@generateReport');
Route::get('resources/generatePDF', 'ResourcesController@generatePDF');
Route::get('resources/removeReport/{id}', 'ResourcesController@removeCart');
Route::get('resources/{resource}', 'ResourcesController@show');
Route::get('resources/{resource}/flag', 'ResourcesController@flag');
Route::post('resources/flag/{resource}', 'ResourcesController@storeFlag');


//flags
Route::get('flags', 'FlagsController@index');
Route::get('flags/{flag}', 'FlagsController@show');
Route::get('flags/{flag}/edit', 'FlagsController@edit');
Route::post('flags/{flag}/resolve', 'FlagsController@resolve');
Route::patch('flags/{flag}', 'FlagsController@update');
Route::delete('flags/{flag}', 'FlagsController@destroy');

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/', 'HomeController@index');
