<?php
Route::pattern('id', '[0-9]+');
//--Home
Route::group(array(), function(){
        // Index
    Route::get('/',array('as'=>'home','uses'=>'HomeController@showIndex'));
    Route::get('home',array('uses'=>'HomeController@showIndex'));
        // Login
    Route::get('login',array('uses'=>'HomeController@showLogin'));
    Route::post('login',array('uses'=>'HomeController@actionLogin'));
        // Logout
    Route::get('logout',array('before' => 'auth','uses'=>'HomeController@actionLogout'));
        // Top
    Route::get('top',array('uses'=>'HomeController@showTopSell'));
        // Search
    Route::post('/',array('uses'=>'HomeController@actionSearch'));
});
//--Product---------------------
Route::group(array('before' => 'auth'), function(){
        // Index
    Route::get('product',array('uses'=>'ProductController@showIndex'));
        // Add
    Route::get('product/add',array('uses'=>'ProductController@showAdd'));
    Route::post('product/add',array('uses'=>'ProductController@actionAdd'));
        // Edit
    Route::get('product/{id}/edit',array('uses'=>'ProductController@showEdit'));
    Route::post('product/{id}/edit',array('uses'=>'ProductController@actionEdit'));
        // View
    Route::get('product/{id}',array('uses'=>'ProductController@showView'));
        // Del
    Route::post('product/{id}',array('uses'=>'ProductController@actionDel'));
        // TopSell
    Route::get('product/top',array('uses'=>'ProductController@showTopSell'));}
);

//--Manager---------------------
        // Add manager
    Route::get('manager/add',array('uses'=>'ManagerController@showAdd'));
    Route::post('manager/add',array('uses'=>'ManagerController@actionAdd'));
Route::group(array('before' => 'auth'), function(){
        // Index
    Route::get('manager',array('uses'=>'ManagerController@showIndex'));
        // View
    Route::get('manager/{id}',array('uses'=>'ManagerController@showView'));
        // Del manager
    Route::post('manager/{id}',array('uses'=>'ManagerController@actionDel'));
        // Shop cal
    Route::get('manager/shop',array('uses'=>'ManagerController@showShopCal'));
    Route::post('manager/shop',array('uses'=>'ManagerController@actionShopCal'));
        // Shop setting
    Route::get('manager/setting',array('uses'=>'ManagerController@showShopSetting'));
    Route::post('manager/setting',array('uses'=>'ManagerController@actionshowShopSetting'));
        // Shop history
    Route::get('manager/history',array('uses'=>'ManagerController@showHistory'));}
);

//--Customer---------------------
Route::group(array('before' => 'auth'), function()
{
        // Add customer
    Route::get('customer/add',array('uses'=>'CustomerController@showAdd'));
    Route::post('customer/add',array('uses'=>'CustomerController@actionAdd'));
        // view + history
    Route::get('customer/{id}',array('uses'=>'CustomerController@showView'));
        // Edit customer
    Route::get('customer/{id}/edit',array('uses'=>'CustomerController@showEdit'));
    Route::post('customer/{id}/edit',array('uses'=>'CustomerController@actionEdit'));
        // del
    Route::post('customer/{id}',array('uses'=>'CustomerController@actionDel'));
});

Route::get('/test', function() {

    $product = App::make('ceddd\\Product');
    $soldItem = App::make('ceddd\\SoldItem');
    $soldItem->set('item',$product->getById('13'));
    $soldItem->set('quantity','1000');
    $soldItem->set('price','99');
    $history = App::make('ceddd\\History');
    $history->set('hid','1234567890');
    $history->set('product_id',$soldItem->get('product')->get('id'));
    $history->set('quantity',$soldItem->get('quantity'));
    $history->set('price',$soldItem->get('price'));
    $history->set('customer_id','26');
    if($history->save()==true)
    return View::make('test');
});
Route::post('/test', function() {
    $data = Input::only(array('hid','product_id','quantity','price','customer_id'));

    $rules = ceddd\HistoryRepository::getRules();

    $validator = Validator::make($data, $rules);
    if ($validator->passes()) {
        $history = App::make('ceddd\\History');
        $history->set('hid',$data['hid']);
        $history->set('product_id',$data['product_id']);
        $history->set('quantity',$data['quantity']);
        $history->set('price',$data['price']);
        $history->set('customer_id',$data['customer_id']);
        if($history->save()==true)
            return Redirect::to('/test')->with('msg',"Add ".$data['hid']."successfull.");
    }
    return Redirect::to('/test')->withErrors($validator);
});


Route::get('/{id}/testEdit', function($id) {
    $history = App::make('ceddd\\History');
    $history = $history->getById($id);
        if($history==NULL)
            return App::abort(404);

        $pd['id'] = $history->get('id');
        $pd['hid'] = $history->get('hid');
        $pd['product_id'] = $history->get('product_id');
        $pd['quantity'] = $history->get('quantity');
        $pd['price'] = $history->get('price');
        $pd['customer_id'] = $history->get('customer_id');
        $pd['created_at'] = $history->get('created_at');
        $pd['updated_at'] = $history->get('updated_at');
        //var_dump($pd);
        //return View::make('product.edit')->with('product',$pd);
    return View::make('testEdit',$pd);
});

Route::post('/{id}/testEdit', function($id) {

        $data = Input::only(array('hid','product_id','quantity','price','customer_id'));

        $rules = ceddd\HistoryRepository::getRules();


        $validator = Validator::make($data, $rules);
        if ($validator->passes()) {
            $pd = App::make('ceddd\History');
            $history = $pd->getById($id);
            $history->set('id',$id);
            $history->set('hid',$data['hid']);
            $history->set('product_id',$data['product_id']);
            $history->set('quantity',$data['quantity']);
            $history->set('price',$data['price']);
            $history->set('customer_id',$data['customer_id']);
            $history->edit();
            return Redirect::to('/'.$id.'/testEdit');
        }
        return Redirect::to('/'.$id.'/testEdit')->withErrors($validator);
});

Route::get('/testGet', function() {
    $history = App::make('ceddd\\History');
    $id = 3;
    $arr = $history->getByProductId($id);
    $count = count($arr);
    for($i = 0;$i < $count;$i++){
        $h = $arr[$i];
        echo $h->get('id')."-".$h->get('hid').$h->get('item')->get('item')->get('name')."-"."-".$h->get('item')->get('quantity')."-".$h->get('item')->get('price');
        echo '\n';
    }
    return View::make('testGet');
   // return Redirect::to('/testGet')->withErrors($validator);
});