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
Route::get('/', 'HomeController@showIndex');

Route::get('index', 'HomeController@showIndex');

Route::match(array('GET', 'POST'),'/add',array('as' => 'add', function () {
    return View::make('add');
}));

Route::match(array('GET', 'POST'), '/history', function()
{
    return View::make('history');
});

Route::match(array('GET', 'POST'), '/product', function()
{
    return View::make('product');
});

Route::get('/calculate', function()
{
    return View::make('calculate');
});

Route::match(array('GET', 'POST'), '/edit', function()
{
    return View::make('edit');
});