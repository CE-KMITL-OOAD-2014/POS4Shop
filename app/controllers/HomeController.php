<?php

class HomeController extends BaseController {

	public function showIndex()
	{
		$product = App::make('ceddd\Product');
		$allProduct = $product->getAll();
		return View::make('home.index')->with('allProduct',$allProduct);
	}

    // Login
	public function showLogin(){
		return View::make('login');
	}

	public function actionLogin(){
		$credentials = Input::only('username', 'password');
		if (Auth::attempt($credentials)) {
			return Redirect::intended('/');
		}
		return Redirect::to('login');
	}

    // Logout
	public function actionLogout(){
		Auth::logout();
		return Redirect::to('/');
	}

    // Top
	public function showTopSell(){

		return View::make('home.index');
	}

    // Search
	public function actionSearch(){

		return View::make('home.index');
	}


}
