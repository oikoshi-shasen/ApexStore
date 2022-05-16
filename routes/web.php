<?php



Route::get('/', function () {return view('welcome');});


Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login.get');
Route::post('login', 'Auth\LoginController@login')->name('login.post');



Route::group(['middleware' => ['auth', 'can:user-higher']], function () {
    Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');
    Route::get('/user', 'UsersController@detail');
    Route::get('carts', 'CartsController@contentsOfCart')->name('cart.contents');
    Route::get('/carts/delete', 'CartsController@deleteCartsGood')->name('delete.cartsgood');
    Route::get('goods', 'GoodsController@index')->name('goods_index');
    Route::get('good/detail','GoodsController@detail');
    Route::get('good/detail/{good_id}','GoodsController@detail');

    Route::post('good/detail','GoodsController@addCarts');
    Route::get('/settle', 'CartsController@settle');
    Route::post('/settled', 'CartsController@settled');
    Route::get('/history', 'UsersController@history');
    Route::post('good/changequantity', 'GoodsController@changeQuantity');
});

Route::group(['middleware' => ['auth', 'can:admin-higher']], function () {
    Route::post('goods/register', 'GoodsController@create')->name('goods.register');
    Route::get('goods/register', function(){return view('goods.create');});
});