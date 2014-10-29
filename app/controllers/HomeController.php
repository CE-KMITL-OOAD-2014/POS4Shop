<?php

class HomeController extends BaseController {

	public function showIndex()
	{
		$product = App::make('ceddd\Product');
		$allProduct = $product->getAll();
		//$allProduct = $product::paginate(2);
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
		$data = Input::get('search');
		$product = App::make('ceddd\Product');
		$searchProduct = $product->find($data);
		//$searchProduct = $product->where('barcode',$data);
		//$searchProduct = array_merge($searchProduct,$product->where('name',$data));
		return View::make('home.search')->with('searchProduct',$searchProduct);
	}
}
