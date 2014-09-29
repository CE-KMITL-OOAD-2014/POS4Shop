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
Route::get('/', function(){
	$var = new MyTestClass();	
	return $var->add(4,5);
});
//Route::get('/', 'HomeController@showIndex');

Route::get('index', 'HomeController@showIndex');

Route::match(array('GET', 'POST'),'/add','ProductController@add');

Route::match(array('GET', 'POST'), '/history', function()
{
    return View::make('history');
});

Route::match(array('GET', 'POST'), '/addcustomer', 'CustomerController@add');

Route::match(array('GET', 'POST'), '/product', 'ProductController@showIndex');

Route::get('/calculate', function()
{
    return View::make('calculate');
});

Route::match(array('GET', 'POST'), '/edit', 'ProductController@edit');