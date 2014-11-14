<?php

class SummaryController extends BaseController {

  public function showDaily(){
    $product = App::make('ceddd\Product');
    $allProduct = $product->getAll();
    //topsell
    $top = Session::get('top', array());
    if(count($top)==0){
      $summary = App::make('ceddd\Summary');
      $top=$summary->getTopSell();
    }
    return View::make('home.index')->with(array('allProduct'=>$allProduct,'top'=>$top));
  }

}
