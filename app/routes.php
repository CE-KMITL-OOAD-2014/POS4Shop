<?php

//TEST feature/class
Route::get('/', function(){ //TODO (ziko) : how to use namespace
	$var = new ceddd\MyTestClass();
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