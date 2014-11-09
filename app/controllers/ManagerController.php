<?php

class ManagerController extends BaseController {

  public function showIndex()
  {
    return View::make('manager.index');
  }
  
  public function showList()
  {
    $manager = App::make('ceddd\Manager');
    $allManager = $manager->getAll();
    return View::make('manager.list')->with('allManager',$allManager);
  }

    // Add manager
  public function showAdd()
  {
    return View::make('manager.add');
  }
  // Change password
  public function actionPassword(){
    $manager = App::make('ceddd\\Manager');
    $manager = $manager->getById(Auth::user()->id);
    if($manager->setPassword(Input::get('oldpwd'),Input::get('newold'),Input::get('conpwd')));
      if($manager->edit())
        return "fail0";
        //return Redirect::to('manager');
    return "fail";
  }

  public function actionAdd()
  {
    $data = Input::only(array('name','username','password'));
    $rules = ceddd\ManagerRepository::getRules();
    $validator = Validator::make($data, $rules);
    if ($validator->passes()) {
      $manager = App::make('ceddd\Manager');
      $manager->set('name',$data['name']);
      $manager->set('username',$data['username']);
      $manager->set('password',Hash::make($data['password']));
      if($manager->save())
        Redirect::to('/manager/add')->with('msg',"Add ".$data['name']." successfull.");
    }
    return Redirect::to('/manager/add')->withErrors($validator);
  }
  public function showView($id){
    $manager = App::make('ceddd\Manager');
    $manager = $manager->getById($id);
    if($manager==NULL)
      return App::abort(404);
    return View::make('manager.view')->with('manager',$manager);
  }

    // Del manager
  public function actionDel(){
    $data  = Input::get("id");
    $manager = App::make('ceddd\Manager');
    $manager = $manager->getById($data);
    $manager->delete();
    return Response::make('delete '.$data, 200);
  }

    // Shop cal
  public function showShopCal(){
    
    $shop = App::make('ceddd\\Shop');
    $arrayOfSoldItem = Session::get('pos', array());
    $manager = App::make('ceddd\\Manager');
    $manager = $manager->getById(Auth::user()->id);
    $customer = Session::get('customer', NULL);
    $customerName='';
    if($customer!=NULL)
      $customerName=$customer->get('name');

    $allPrice = $shop->cal($arrayOfSoldItem,$manager,NULL);

    return View::make('manager.pos')->with(array('pos'=>Session::get('pos', array()),'allPrice'=>$allPrice,'customer'=>$customerName));
  }

  public function actionShopCal(){
        // Selecto Customer Here
    $customer = Session::get('customer',NULL);
    
        // Make history obj and save
    $arrayOfSoldItem = Session::get('pos', array());
    $manager = App::make('ceddd\\Manager');
    $manager = $manager->getById(Auth::user()->id);

    $shop = App::make('ceddd\\Shop');
    if($shop->buy($arrayOfSoldItem,$manager,$customer)){
      Session::forget('pos');
      Session::forget('customer');
    }
    return Redirect::to('manager/shop');
  }

  public function showShopCalProduct(){
    $data = Input::get('search');
    $product = App::make('ceddd\Product');
    $searchProduct = $product->find($data);

    return View::make('manager.product')->with(array('searchProduct'=>$searchProduct,'search'=>$data));
  }

  public function actionShopCalProduct($id){
        //TODO (ziko) : Move this into Class sth..
    $product = App::make('ceddd\Product');
    $product = $product->getById($id);

    $arrayOfSoldItem = Session::get('pos', array());
    
    $soldItem = App::make('ceddd\SoldItem');
    $soldItem->set('item',$product);

    $isHas=array_key_exists(strval($soldItem->get('item')->get('barcode')),$arrayOfSoldItem);
    if($isHas){
      $soldItemOld = $arrayOfSoldItem[strval($soldItem->get('item')->get('barcode'))];
      $soldItem->set('quantity',$soldItemOld->get('quantity')+1);        
    }
    else
      $soldItem->set('quantity',1);

    $soldItem->set('price',$product->get('price'));
    $arrayOfSoldItem[strval($soldItem->get('item')->get('barcode'))] = $soldItem;
    Session::put('pos', $arrayOfSoldItem);
    return Redirect::to('manager/shop');
        //return Redirect::to('manager.pos')->withCookie(array($cookieB,$cookieN,$cookieP,$cookieQ,$cookieLength));
  }

  public function actionShopCalProductDelete($barcode){
    if($barcode==0){
      Session::put('pos', array());
      return 1;
    }
    
    $arrayOfSoldItem = Session::get('pos', array());
    $isHas=array_key_exists($barcode,$arrayOfSoldItem);
    if($isHas){
      unset($arrayOfSoldItem[$barcode]);
      Session::put('pos', $arrayOfSoldItem);
      return 1;
    }
    return 0;
    
  }

  public function showShopCalCustomer(){
    $data = Input::get('search');
    $customer = App::make('ceddd\Customer');
    $searchCustomer = $customer->find($data);
    return View::make('manager.customer')->with(array('searchCustomer'=>$searchCustomer,'search'=>$data));

  }
  public function actionShopCalCustomer($id){
    $customer = App::make('ceddd\Customer');
    Session::put('customer', $customer->getById($id));
    return Redirect::to('manager/shop');
  }

  // Shop setting
  public function actionShopSetting(){

  }

}
