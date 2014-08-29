<?php

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
//TEST feature/class
Route::get('/', function()
{
	return View::make('index');
});

Route::get('/index', function()
{
    return View::make('index');
});

Route::match(array('GET', 'POST'),'/add',array('as' => 'add', function () {
    return View::make('add');
}));
