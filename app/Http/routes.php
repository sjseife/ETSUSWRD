<?php
use App\Flag;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	if(Auth::guest())
	{
		return redirect(url('/login'));
	}
	$flags = count(Flag::all());
	return View::make('home', compact('flags'));
});

Route::get('/charts', function()
{
	return View::make('mcharts');
});


Route::get('/tables', function()
{
	return View::make('table');
});

Route::get('/forms', function()
{
	return View::make('form');
});

Route::get('/grid', function()
{
	return View::make('grid');
});

Route::get('/buttons', function()
{
	return View::make('buttons');
});


Route::get('/icons', function()
{
	return View::make('icons');
});

Route::get('/panels', function()
{
	return View::make('panel');
});

Route::get('/typography', function()
{
	return View::make('typography');
});

Route::get('/notifications', function()
{
	return View::make('notifications');
});

Route::get('/blank', function()
{
	return View::make('blank');
});


Route::get('/documentation', function()
{
	return View::make('documentation');
});



Route::auth();

Route::get('/home', 'HomeController@index');

Route::group(['middleware' => ['web']], function () {
	// your routes here
});

Route::get('/auth/newPassword',function(){
    return view('/auth/newPassword', array('user' => Auth::user(), 'errors' => array()));
});
Route::patch('auth/newPassword/{user}', 'NewPassController@updatePass');

Route::get('/team', function () {
	return view('team');
});


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

	//flag
	Route::get('/flag', 'FlagController@index');
	Route::get('flag/create', 'FlagController@create');             //admin specific
	Route::post('flag/createFlag', 'FlagController@createFlag');

	//user
	Route::get('/users', 'UserController@index');
	Route::get('/user/view/{id}', 'UserController@view');
	Route::get('user/create', 'UserController@create');
	Route::post('user/createUser', 'UserController@createUser');
	Route::get('/user/edit/{id}', 'UserController@edit');
	Route::patch('user/{id}', 'UserController@update');
	Route::get('user/delete/{id}', 'UserController@delete');
	Route::delete('user/destroy/{id}', 'UserController@destroy');


	Route::get('/contact/edit/{id}', 'ContactController@edit');
	Route::patch('/contact/{id}', 'ContactController@update');
	Route::get('/contact/view/{id}', 'ContactController@view');
	Route::get('/contact', 'ContactController@index');
	Route::get('contact/create', 'ContactController@create');
	Route::post('contact/createContact', 'ContactController@createContact');
	Route::get('contact/delete/{id}', 'ContactController@delete');
	Route::delete('contact/destroy/{id}', 'ContactController@destroy');
});

//if GA or Admin is required, place route in this group
Route::group(['middleware' => 'App\Http\Middleware\GAMiddleware'], function()
{
	//category
	Route::get('/category', 'CategoryController@index');
	Route::get('category/create', 'CategoryController@create');
	Route::post('category/store', 'CategoryController@store');
	Route::get('category/edit/{id}', 'CategoryController@edit');
	Route::patch('category/{id}', 'CategoryController@update');
	Route::get('category/view/{id}', 'CategoryController@view');

	//resource
	Route::get('/resources/generateReport', 'ResourceController@generateReport');
	Route::get('/resources/generatePDF', 'ResourceController@generatePDF');
	Route::get('resources/create', 'ResourceController@create');
	Route::post('resources', 'ResourceController@store');
	Route::get('resources/edit/{resource}', 'ResourceController@edit');
	Route::patch('resources/{resource}', 'ResourceController@update');
	Route::get('resources/add/{resource}', 'ResourceController@add');

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
    Route::get('contact/resourceview/{id}', 'ContactController@resourceView');
});


Route::get('resources', 'ResourceController@index');
Route::get('/resource/generateReport', 'ResourceController@generateReport');
Route::get('/resource/generatePDF', 'ResourceController@generatePDF');
Route::get('resource/removeReport/{id}', 'ResourceController@removeCart');
Route::get('resources/{resource}', 'ResourceController@show');

