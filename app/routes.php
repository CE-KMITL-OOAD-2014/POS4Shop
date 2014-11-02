<?php

Route::pattern('id', '[0-9]+');

//--Home
Route::group(array(), function(){
        // Index
    Route::get('/',array('as'=>'home','uses'=>'HomeController@showIndex'));
    Route::get('home',array('uses'=>'HomeController@showIndex'));
        // Login
    Route::get('login',array('uses'=>'HomeController@showLogin','https'=>'https'));
    Route::post('login',array('uses'=>'HomeController@actionLogin','https'=>'https'));
        // Logout
    Route::get('logout',array('before' => 'auth','uses'=>'HomeController@actionLogout','https'=>'https'));
        // Top
    Route::get('top',array('uses'=>'HomeController@showTopSell'));
        // Search
    Route::get('/search',array('uses'=>'HomeController@actionSearch'));
});
//--Product---------------------
    // Index
Route::get('product',array('uses'=>'ProductController@showIndex'));
    // View
Route::get('product/{id}',array('uses'=>'ProductController@showView'));
    // TopSell
Route::get('product/top',array('uses'=>'ProductController@showTopSell'));

Route::group(array('before' => 'auth'), function(){
        // Add
    Route::get('product/add',array('uses'=>'ProductController@showAdd'));
    Route::post('product/add',array('uses'=>'ProductController@actionAdd'));
        // Edit
    Route::get('product/{id}/edit',array('uses'=>'ProductController@showEdit'));
    Route::post('product/{id}/edit',array('uses'=>'ProductController@actionEdit'));
        // Del
    Route::post('product/{id}',array('uses'=>'ProductController@actionDel'));
//    }
//);

//--Manager---------------------
//Route::group(array('before' => 'auth'), function(){
        // Add manager
    Route::get('manager/add',array('uses'=>'ManagerController@showAdd'));
    Route::post('manager/add',array('uses'=>'ManagerController@actionAdd'));    
        // Index
    Route::get('manager',array('uses'=>'ManagerController@showIndex'));
        // View
    Route::get('manager/{id}',array('uses'=>'ManagerController@showView'));
        // Del manager
    Route::post('manager/{id}',array('uses'=>'ManagerController@actionDel'));
        // Shop cal
    Route::get('manager/shop',array('uses'=>'ManagerController@showShopCal'));
    Route::post('manager/shop',array('uses'=>'ManagerController@actionShopCal'));

    Route::post('manager/shop/product',array('uses'=>'ManagerController@showShopCalProduct'));
    Route::get('manager/shop/product/{id}',array('uses'=>'ManagerController@actionShopCalProduct'));
    Route::post('manager/shop/product/{barcode}/del',array('uses'=>'ManagerController@actionShopCalProductDelete'));

    Route::get('manager/shop/customer',array('uses'=>'ManagerController@actionShopCalCustomer')); //Customer Finder and Select
    //Route::post('manager/shop/select',array('uses'=>'ManagerController@actionShopCalCustomer'));
        // Shop setting
    Route::get('manager/setting',array('uses'=>'ManagerController@showShopSetting'));
    Route::post('manager/setting',array('uses'=>'ManagerController@actionshowShopSetting'));
        // Shop history
    Route::get('manager/history',array('uses'=>'ManagerController@showHistory'));
//}
//);

//--Customer---------------------
//Route::group(array('before' => 'auth'), function()
//{
    Route::get('customer',array('uses'=>'CustomerController@showIndex'));
        // Add customer
    Route::get('customer/add',array('uses'=>'CustomerController@showAdd'));
    Route::post('customer/add',array('uses'=>'CustomerController@actionAdd'));
        // view + history
    Route::get('customer/{id}',array('uses'=>'CustomerController@showView'));
        // Edit customer
    Route::get('customer/{id}/edit',array('uses'=>'CustomerController@showEdit'));
    Route::post('customer/{id}/edit',array('uses'=>'CustomerController@actionEdit'));
    Route::get('customer/{id}/history',array('uses'=>'CustomerController@showHistory'));
        // del
    Route::post('customer/{id}',array('uses'=>'CustomerController@actionDel'));


//--History---------------------
    Route::get('history',array('uses'=>'HistoryController@showView'));

});
