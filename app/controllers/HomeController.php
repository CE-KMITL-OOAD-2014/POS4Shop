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
      return Redirect::intended('manager/shop');
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
    //Keep it in Session
    $top = Session::get('top', array());
    if(count($top)==0){
      $summary = App::make('ceddd\Summary');
      $top=$summary->getTopSell();
    }
		return View::make('home.index')->with('allProduct',$top);
  }

    // Search
	public function actionSearch(){
		$data = Input::get('search');
		$product = App::make('ceddd\Product');
		$searchProduct = $product->find($data);
		return View::make('home.search')->with(array('searchProduct'=>$searchProduct,'search'=>$data));
	}
}
