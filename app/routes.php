<?php

Route::pattern('id', '[0-9]+');
//,'https'=>'https'
Route::group(array(), function(){
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
        Route::get('/search',array('uses'=>'HomeController@actionSearch'));
    });
    //--Product---------------------
    Route::group(array('prefix'=>'product'), function(){
            // Index
        Route::get('/',array('uses'=>'ProductController@showIndex'));
            // View
        Route::get('{id}',array('uses'=>'ProductController@showView'));
            // TopSell
        // Route::get('top',array('uses'=>'ProductController@showTopSell'));
            // Add
        Route::get('add',array('uses'=>'ProductController@showAdd','before' => 'auth'));
        Route::post('add',array('uses'=>'ProductController@actionAdd','before' => 'auth'));
            // Edit
        Route::get('{id}/edit',array('uses'=>'ProductController@showEdit','before' => 'auth'));
        Route::post('{id}/edit',array('uses'=>'ProductController@actionEdit','before' => 'auth'));
            // Del
        Route::post('{id}',array('uses'=>'ProductController@actionDel','before' => 'auth'));
    });

    //--Manager---------------------
    Route::group(array('prefix'=>'manager','before' => 'auth'), function(){
            // Dashboard
        Route::get('/',array('uses'=>'ManagerController@showIndex'));
            // list
        Route::get('list',array('uses'=>'ManagerController@showList'));
            // Add manager
        Route::get('add',array('uses'=>'ManagerController@showAdd'));
        Route::post('add',array('uses'=>'ManagerController@actionAdd'));    
            // View
        Route::get('{id}',array('uses'=>'ManagerController@showView'));
            // Del manager
        Route::post('{id}',array('uses'=>'ManagerController@actionDel'));
            // Manager change Shop name
        Route::post('name',array('uses'=>'ManagerController@actionName'));
            // Manager change pwd
        Route::post('pwd',array('uses'=>'ManagerController@actionPassword'));

            // Shop setting
        // Route::get('manager/setting',array('uses'=>'ManagerController@showShopSetting'));
        // Route::post('manager/setting',array('uses'=>'ManagerController@actionshowShopSetting'));
            // Shop history
        Route::get('manager/history',array('uses'=>'ManagerController@showHistory'));
        
        Route::group(array('prefix'=>'shop'), function(){
                // Shop cal
            Route::get('/',array('uses'=>'ManagerController@showShopCal'));
            Route::post('/',array('uses'=>'ManagerController@actionShopCal'));

            Route::post('product',array('uses'=>'ManagerController@showShopCalProduct'));
            Route::get('product/{id}',array('uses'=>'ManagerController@actionShopCalProduct'));
            Route::post('product/{barcode}/del',array('uses'=>'ManagerController@actionShopCalProductDelete'));

            Route::post('customer',array('uses'=>'ManagerController@showShopCalCustomer'));
            Route::get('customer/{id}',array('uses'=>'ManagerController@actionShopCalCustomer')); //Customer Finder and Select
            //Route::post('shop/select',array('uses'=>'ManagerController@actionShopCalCustomer'));
        });
    });

    //--Customer---------------------
    Route::group(array('prefix'=>'customer'), function(){
        Route::get('/',array('uses'=>'CustomerController@showIndex','before' => 'auth'));
            // Add customer
        Route::get('add',array('uses'=>'CustomerController@showAdd','before' => 'auth'));
        Route::post('add',array('uses'=>'CustomerController@actionAdd','before' => 'auth'));
            // view + history
        Route::get('{id}',array('uses'=>'CustomerController@showView'));
            // Edit customer
        Route::get('{id}/edit',array('uses'=>'CustomerController@showEdit','before' => 'auth'));
        Route::post('{id}/edit',array('uses'=>'CustomerController@actionEdit','before' => 'auth'));
            // History  //Route::get('{id}/history',array('uses'=>'CustomerController@showHistory'));
            // del
        Route::post('customer/{id}',array('uses'=>'CustomerController@actionDel','before' => 'auth'));
    });

    //--History---------------------
        Route::get('history',array('uses'=>'HistoryController@showView'));
});