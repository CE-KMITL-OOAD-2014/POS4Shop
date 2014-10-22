<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showIndex()
	{
		return View::make('home.index');
	}

	public function showAdd()
	{
		return View::make('home.index');
	}
	
	public function actionAdd()
	{
		return View::make('home.index');
	}

	public function showTopSell()
	{
		return View::make('home.index');
	}

}
