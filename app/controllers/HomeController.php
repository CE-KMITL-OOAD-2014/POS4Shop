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
        $product = App::make('ceddd\Product');
        $product = $product->getAll();
        $history = App::make('ceddd\History');
        $resultCount = array();
        $count = 0;
        $arrCount = 0;
        foreach($product as $val){
            $history->getByProductID($val->get('id'));
            if(count($history) != 0){
                $resultCount[$arrCount][0] = $history[0]->get('hid');
                $resultCount[$arrCount][1] = count($history);
                $arrCount++;
            }
        }
        //SORTTTT
	}

    // Search
	public function actionSearch(){
		$data = Input::get('search');
		$product = App::make('ceddd\Product');
		$searchProduct = $product->find($data);
		//$searchProduct = $product->where('barcode',$data);
		//$searchProduct = array_merge($searchProduct,$product->where('name',$data));
		return View::make('home.search')->with(array('searchProduct'=>$searchProduct,'search'=>$data));
	}
}
