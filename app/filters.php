<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::guest('signin');
		}
	}
});

Route::filter('auth.basic', function()
{
	return Auth::basic();
});


/*
|--------------------------------------------------------------------------
| Filter user level is admin
|--------------------------------------------------------------------------
|
| Check session['admin'] is admin or not.
| If session['admin'] is not admin then
| is redirect to sign in page
|
*/
Route::filter('admin_dashboard', function()
{
  
	if (Session::get('admin') !== 'admin') 
		return Redirect::route('signin-get');
});
Route::when('admin', 'admin_dashboard');

Route::filter('admin', function()
{
  
	if (Session::get('admin') !== 'admin') 
		return Redirect::route('signin-get');
});
Route::when('admin/*', 'admin');

/*
|--------------------------------------------------------------------------
| Filter user level is employee
|--------------------------------------------------------------------------
|
| Check session['employee'] is employee or not.
| If session['employee'] is not employee then
| is redirect to sign in page
|
*/
Route::filter('employee_dashboard', function()
{
  
	if (Session::get('employee') !== 'employee') 
		return Redirect::route('signin-get');
});
Route::when('employee', 'employee_dashboard');

Route::filter('employee', function()
{
  
	if (Session::get('employee') !== 'employee') 
		return Redirect::route('signin-get');
});
Route::when('employee/*', 'employee');


/*
|--------------------------------------------------------------------------
| Filter user level is member
|--------------------------------------------------------------------------
|
| Check session['member'] is member or not.
| If session['member'] is not member then
| is redirect to sign in page
|
*/
Route::filter('member_dashboard', function()
{
  
	if (Session::get('member') !== 'member') 
		return Redirect::route('signin-get');
});
Route::when('member', 'member_dashboard');

Route::filter('member', function()
{
  
	if (Session::get('member') !== 'member') 
		return Redirect::route('signin-get');
});
Route::when('member/*', 'member');


/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::route('home');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});
