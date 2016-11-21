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


Route::group(['middleware' => 'App\Http\Middleware\CreateUpdateMiddleware'], function()
{
    //event
    Route::get('events/create', 'EventsController@create');
    Route::post('events', 'EventsController@store');
    Route::get('events/{event}/edit', 'EventsController@edit');
    Route::patch('events/{event}', 'EventsController@update');

    //resource
    Route::get('resources/create', 'ResourcesController@create');//resource creation form
    Route::post('resources', 'ResourcesController@store');//save a new resource
    Route::get('resources/{resource}/edit', 'ResourcesController@edit');//resource edit form
    Route::patch('resources/{resource}', 'ResourcesController@update');//resource edit save

    //contacts
    Route::get('contacts/create', 'ContactsController@create');
    Route::get('contacts/{contact}/edit', 'ContactsController@edit');
    Route::post('contacts', 'ContactsController@store');
    Route::patch('contacts/{contact}', 'ContactsController@update');
    Route::post('contactsJSON', 'ContactsController@storeJSON');

    //categories
    Route::get('categories/create', 'CategoryController@create');
    Route::get('categories/{category}/edit', 'CategoryController@edit');
    Route::post('categories', 'CategoryController@store');
    Route::patch('categories/{category}', 'CategoryController@update');

});

Route::group(['middleware' => 'App\Http\Middleware\BaseMiddleware'], function()
{
    //event
    Route::get('events', 'EventsController@index');
    Route::get('events/{event}', 'EventsController@show');
    Route::get('events/add/{event}', 'EventsController@add'); //add resource to report
    Route::get('events/removeReport/{event}', 'EventsController@removeReport');
    Route::get('events/{event}/flag', 'EventsController@flag');
    Route::post('events/flag/{event}', 'EventsController@storeFlag');

    //resource
    Route::get('resources', 'ResourcesController@index');
    Route::get('resources/add/{resource}', 'ResourcesController@add'); //add resource to report
    Route::get('resources/removeReport/{resource}', 'ResourcesController@removeReport');
    Route::get('resources/{resource}', 'ResourcesController@show');
    Route::get('resources/{resource}/flag', 'ResourcesController@flag');
    Route::post('resources/flag/{resource}', 'ResourcesController@storeFlag');

    //worklist
    Route::get('worklist/emptyReport', 'WorkListController@emptyReport');
    Route::get('worklist/generateReport', 'WorkListController@generateReport');
    Route::get('worklist/generatePDF', 'WorkListController@generatePDF');
    Route::get('worklist/mobileReport', 'WorkListController@mobileReport');
});

Route::group(['middleware' => 'App\Http\Middleware\ExtendedMiddleware'], function()
{
    //contacts
    Route::get('contacts', 'ContactsController@index');
    Route::get('contacts/{contact}', 'ContactsController@show');
    Route::get('contacts/{contact}/flag', 'ContactsController@flag');
    Route::post('contacts/flag/{contact}', 'ContactsController@storeFlag');

    //categories
    Route::get('categories', 'CategoryController@index');
    Route::get('categories/{category}', 'CategoryController@show');
    Route::delete('categories/{category}', 'CategoryController@destroy');

    //flags
    Route::get('/flags/count', 'FlagsController@count');
    Route::get('flags', 'FlagsController@index');
    Route::get('flags/{flag}', 'FlagsController@show');
    Route::get('flags/{flag}/edit', 'FlagsController@edit');
    Route::post('flags/{flag}/resolve', 'FlagsController@resolve');
    Route::patch('flags/{flag}', 'FlagsController@update');
    Route::delete('flags/{flag}', 'FlagsController@destroy');

});

Route::group(['middleware' => 'App\Http\Middleware\DeleteMiddleware'], function()
{
    //event
    Route::delete('events/{event}', 'EventsController@destroy');

    //resource
    Route::delete('resources/{resource}', 'ResourcesController@destroy');

    //contact
    Route::delete('contacts/{contact}', 'ContactsController@destroy');
});

Route::group(['middleware' => 'App\Http\Middleware\ArchiveMiddleware'], function()
{
    //archive
    Route::get('archive', 'ArchiveController@index');

    //archive events
    Route::get('archive_events', 'ArchiveEventsController@index');
    Route::get('archive_events/restore/{event}', 'ArchiveEventsController@restore');
    Route::get('archive_events/{event}', 'ArchiveEventsController@show');
    Route::get('archive_events/showrestore/{event}', 'ArchiveEventsController@showRestore');

    //archive resources
    Route::get('archive_resources', 'ArchiveResourcesController@index');
    Route::get('archive_resources/restore/{resource}', 'ArchiveResourcesController@restore');
    Route::get('archive_resources/{resource}', 'ArchiveResourcesController@show');
    Route::get('archive_resources/showrestore/{resource}', 'ArchiveResourcesController@showRestore');

    //archive contacts
    Route::get('archive_contacts', 'ArchiveContactsController@index');
    Route::get('archive_contacts/restore/{contact}', 'ArchiveContactsController@restore');
    Route::get('archive_contacts/{contact}', 'ArchiveContactsController@show');
    Route::get('archive_contacts/showrestore/{contact}', 'ArchiveContactsController@showRestore');

    //archive categories
    Route::get('archive_categories', 'ArchiveCategoryController@index');
    Route::get('archive_categories/restore/{category}', 'ArchiveCategoryController@restore');
    Route::get('archive_categories/{category}', 'ArchiveCategoryController@show');
    Route::get('archive_categories/showrestore/{category}', 'ArchiveCategoryController@showRestore');

    //archive flags
    Route::get('archive_flags', 'ArchiveFlagsController@index');
    Route::get('archive_flags/restore/{flag}', 'ArchiveFlagsController@restore');
    Route::get('archive_flags/{flag}', 'ArchiveFlagsController@show');
    Route::get('archive_flags/showrestore/{flag}', 'ArchiveFlagsController@showRestore');

    //archive users
    Route::get('archive_users', 'ArchiveUsersController@index');
    Route::get('archive_users/restore/{user}', 'ArchiveUsersController@restore');
    Route::get('archive_users/{user}', 'ArchiveUsersController@show');
    Route::get('archive_users/showrestore/{user}', 'ArchiveUsersController@showRestore');
});

Route::group(['middleware' => 'App\Http\Middleware\UsersMiddleware'], function()
{
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

Route::group(['middleware' => 'App\Http\Middleware\RolesMiddleware'], function()
{
    Route::get('roles', 'RolesController@index');
    Route::post('roles/createNew', 'RolesController@createNew');
    Route::post('roles', 'RolesController@store');
});

Route::auth();

Route::get('/home/errorAdmin', 'HomeController@errorAdmin');
Route::get('/home/errorGA', 'HomeController@errorGA');
Route::get('/home', 'HomeController@index');
Route::get('/', 'HomeController@index');
