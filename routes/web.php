<?php



Route::get('/', function () {return view('welcome');});



Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login.get');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');




Route::group(['middleware' => ['auth']], function () {
    Route::get('/user', 'UsersController@detail');
    Route::get('carts', 'CartsController@contentsOfCart');
    Route::get('carts/delete', 'CartsController@deleteCartsGood')->name('delete.cartsgood');
    Route::get('goods', 'GoodsController@index')->name('goods_index');
    Route::post('goods/register', 'GoodsController@create')->name('goods.register');
    Route::get('goods/register', function(){return view('goods.create');});
    Route::get('good/detail','GoodsController@detail');
    Route::get('good/detail/{good_id}','GoodsController@detail');
    Route::post('good/changequantity', 'GoodsController@changeQuantity');
    Route::post('good/detail','GoodsController@addCarts');
    Route::get('settle', 'CartsController@settle');
    Route::get('settled', 'CartsController@settled');
});