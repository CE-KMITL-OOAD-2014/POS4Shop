<?php

Route::pattern('id', '[0-9]+');
Route::pattern('day', '^(0?[1-9]|1[0-9]|3[01])$');
Route::pattern('month', '^(0?[1-9]|1[012])$');
Route::pattern('year', '^\d{4}$');
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
            // Search
        Route::get('/search',array('uses'=>'HomeController@actionSearch'));
    });
    //--Product---------------------
    Route::group(array('prefix'=>'product'), function(){
            // Index
        Route::get('/',array('uses'=>'ProductController@showIndex'));
            // View
        Route::get('{id}',array('uses'=>'ProductController@showView'));
            // Add
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
        Route::post('add',array('uses'=>'ManagerController@actionAdd'));    
            // View
        Route::get('{id}',array('uses'=>'ManagerController@showView'));
            // Del manager
        Route::post('{id}',array('uses'=>'ManagerController@actionDel'));
            // Manager change Shop name
        Route::post('name',array('uses'=>'ManagerController@actionName'));
            // Manager change pwd
        Route::post('pwd',array('uses'=>'ManagerController@actionPassword'));
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
            Route::get('customer/{id}',array('uses'=>'ManagerController@actionShopCalCustomer'));
        });
    });

    //--Customer---------------------
    Route::group(array('prefix'=>'customer'), function(){
        Route::get('/',array('uses'=>'CustomerController@showIndex','before' => 'auth'));
            // Add customer
        Route::post('add',array('uses'=>'CustomerController@actionAdd','before' => 'auth'));
            // view + history
        Route::get('{id}',array('uses'=>'CustomerController@showView'));
            // Edit customer
        Route::get('{id}/edit',array('uses'=>'CustomerController@showEdit','before' => 'auth'));
        Route::post('{id}/edit',array('uses'=>'CustomerController@actionEdit','before' => 'auth'));
            // del
        Route::post('{id}',array('uses'=>'CustomerController@actionDel','before' => 'auth'));
    });

    //--History---------------------
    Route::group(array('prefix'=>'history','before' => 'auth'), function(){
        Route::get('/',array('uses'=>'HistoryController@showView'));
        Route::post('/',array('uses'=>'HistoryController@actionDel'));
    });

    //--Summary---------------------
    Route::group(array('prefix'=>'summary','before' => 'auth'), function(){
        //summary/year/month/day
        Route::get('/',array('uses'=>'SummaryController@showIndex'));
        Route::post('/',array('uses'=>'SummaryController@actionIndex'));
        Route::get('/{year}/{month}',array('uses'=>'SummaryController@showMonthly'));
        Route::get('/{year}/{month}/{day}',array('uses'=>'SummaryController@showDaily'));
        //Route::get('/{year}/{month}/{day}',array('uses'=>'SummaryController@showDaily'));
    });

    //--API---------------------
    Route::group(array('prefix'=>'api'), function(){
        Route::get('history/{id}', 'CustomerController@api');
        Route::get('product/{id}', 'ProductController@api');
    });
});