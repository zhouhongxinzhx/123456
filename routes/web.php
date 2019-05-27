<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('index/index');
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'Index\IndexController@index');

Route::prefix('/login')->group(function(){
    Route::get('login','Index\LoginController@login');
    Route::post('logindo','Index\LoginController@logindo');
    Route::get('logout','Index\LoginController@logout');
    Route::get('register','Index\LoginController@register');
    Route::post('sendEmail','Index\LoginController@sendEmail');
    Route::post('sendmail','Index\LoginController@sendmail');
    Route::get('test','Index\LoginController@test');
    Route::post('regsubmit','Index\LoginController@regsubmit');
});

Route::prefix('/user')->group(function(){
    Route::get('index','Index\UserController@index');

});

Route::prefix('/goods')->group(function(){
    Route::get('list/{id?}','Index\GoodsController@list');
    Route::get('getCateId','Index\GoodsController@getCateId');
    Route::post('goodstype','Index\GoodsController@goodstype');
    Route::get('detail/{id}','Index\GoodsController@detail');
});

Route::prefix('/cart')->group(function(){
    Route::post('addcart','Index\CartController@addcart');
    Route::get('cartlist','Index\CartController@cartlist');
    Route::post('changeNumber','Index\CartController@changeNumber');
    Route::post('getTotal','Index\CartController@getTotal');
    Route::post('getCount','Index\CartController@getCount');
    Route::get('confirm/{id}','Index\CartController@confirm');
});

Route::prefix('/address')->group(function(){
    Route::get('add','Index\AddressController@add');
    Route::post('getArea','Index\AddressController@getArea');
    Route::get('getAreaInfo/{id}','Index\AddressController@getAreaInfo');
    Route::post('addressadd','Index\AddressController@addressadd');
});

Route::prefix('/order')->group(function(){
    Route::post('confirmOrder','Index\OrderController@confirmOrder');
    Route::get('success/{id}','Index\OrderController@success');
    Route::get('pay','Index\OrderController@pay');
    Route::get('merpay','Index\OrderController@merpay');//电脑支付
    Route::get('returnpay','Index\OrderController@returnpay');
});

Route::prefix('/news')->group(function(){
    Route::get('/add','admin\NewsController@add');
    Route::post('/doadd','admin\NewsController@doadd');
    Route::get('/index','admin\NewsController@index');
    Route::get('/detail/{id}','admin\NewsController@detail');
    Route::get('/edit/{id}','admin\NewsController@edit');
    Route::get('/del/{id}','admin\NewsController@del');

});
Route::prefix('/book')->group(function(){
	Route::get('add','NewsController@create');
	Route::get('list','NewsController@index');
	Route::post('addHandle','NewsController@store');
    Route::get('edit/{id}','NewsController@edit');
	Route::any('update','NewsController@update');    
    Route::get('del','NewsController@destroy');
	Route::post('checkName','NewsController@checkName');
    
});
Route::prefix('/shangpin')->group(function(){
	Route::get('add','ShangpinController@create');
	Route::get('list','ShangpinController@index');
	Route::post('add_do','ShangpinController@store');
	Route::get('edit/{id}','ShangpinController@edit');
	Route::post('update/{id}','ShangpinController@update');
	Route::post('del/{shang_id}','ShangpinController@destroy');
	Route::get('xiangqing/{news_id}','ShangpinController@xiangqing');
});