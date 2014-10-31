<?php

class ManagerController extends BaseController {

    public function showIndex()
    {
        return "manager";
    }

    // Add manager
    public function showAdd()
    {
        return View::make('manager.add');
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

        $allPrice = $shop->cal($arrayOfSoldItem,$manager,NULL);

        return View::make('manager.pos')->with(array('pos'=>Session::get('pos', array()),'allPrice'=>$allPrice));
    }

    public function actionShopCal(){
        return $id;

    }

    public function showShopCalProduct(){
        $data = Input::get('search');
        $product = App::make('ceddd\Product');
        $searchProduct = $product->find($data);

        return View::make('manager.product')->with(array('searchProduct'=>$searchProduct,'search'=>$data));

    }

    public function actionShopCalProduct($id){

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

    public function actionShopCalCustomer(){

    }

    // Shop setting
    public function showShopSetting(){

    }
    public function actionshowShopSetting(){

    }

    // Shop history
    public function showHistory(){

    }
}
