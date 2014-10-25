<?php

// Home
    // Index
Route::get('/',array('uses'=>'HomeController@showIndex'));
Route::get('home',array('uses'=>'HomeController@showIndex'));
    // Top
Route::get('home/top',array('uses'=>'HomeController@showTopSell'));
    // Search
Route::get('home/add',array('uses'=>'HomeController@showAdd'));
Route::post('home/add',array('uses'=>'HomeController@actionAdd'));

//--Product
    // Add
Route::get('product/add',array('uses'=>'ProductController@showAdd'));
Route::post('product/add',array('uses'=>'ProductController@actionAdd'));
    // Edit
Route::get('product/edit',array('uses'=>'ProductController@showEdit'));
Route::post('product/edit',array('uses'=>'ProductController@actionEdit'));
    // View
Route::get('product/view',array('uses'=>'ProductController@showView'));
    // Del
Route::get('product/del',array('uses'=>'ProductController@showDel'));
Route::post('product/del',array('uses'=>'ProductController@actionDel'));
    // TopSell
Route::get('product/top',array('uses'=>'ProductController@showTopSell'));

//--Manager
    // Add manager
Route::get('manager/add',array('uses'=>'ManagerController@showAdd'));
Route::post('manager/add',array('uses'=>'ManagerController@actionAdd'));
    // Del manager
Route::get('manager/add',array('uses'=>'ManagerController@showAdd'));
Route::post('manager/add',array('uses'=>'ManagerController@actionAdd'));
    // Shop cal
Route::get('manager/shop',array('uses'=>'ManagerController@showShopCal'));
Route::post('manager/shop',array('uses'=>'ManagerController@actionShopCal'));
    // Shop setting
Route::get('manager/setting',array('uses'=>'ManagerController@showShopSetting'));
Route::post('manager/setting',array('uses'=>'ManagerController@actionshowShopSetting'));
    // Shop history
Route::get('manager/history',array('uses'=>'ManagerController@showHistory'));

//--Customer
    // Add customer
Route::get('customer/add',array('uses'=>'CustomerController@showAdd'));
Route::post('customer/add',array('uses'=>'CustomerController@actionAdd'));
    // del
Route::get('customer/del',array('uses'=>'CustomerController@showDel'));
Route::post('customer/del',array('uses'=>'CustomerController@actionDel'));
    // history
Route::get('customer/history',array('uses'=>'CustomerController@showHistory'));



//----------REAL-END--------------
/*
//Route::get('/', 'HomeController@showIndex');

Route::get('index', 'HomeController@showIndex');

Route::match(array('GET', 'POST'),'/add','ProductController@add');

Route::match(array('GET', 'POST'), '/history', function()
{
    return View::make('history');
});

Route::match(array('GET', 'POST'), '/addcustomer', 'CustomerController@add');

Route::match(array('GET', 'POST'), '/product', 'ProductController@showIndex');

Route::get('/calculate', function()
{
    return View::make('calculate');
});

Route::match(array('GET', 'POST'), '/edit', 'ProductController@edit');
*/