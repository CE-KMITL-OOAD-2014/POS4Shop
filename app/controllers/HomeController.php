<?php

class HomeController extends BaseController {

	public function showIndex()
	{
		$product = App::make('ceddd\Product');
		$allProduct = $product->getAll();
		return View::make('home.index')->with('allProduct',$allProduct);
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
