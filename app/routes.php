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
    Route::post('search',array('uses'=>'HomeController@actionSearch'));
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
Route::group(array('before' => 'auth'), function(){
        // Index
    Route::get('manager',array('uses'=>'ManagerController@showIndex'));
        // Add manager
    Route::get('manager/add',array('uses'=>'ManagerController@showAdd'));
    Route::post('manager/add',array('uses'=>'ManagerController@actionAdd'));
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