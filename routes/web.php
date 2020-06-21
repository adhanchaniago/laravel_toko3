<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'ecommerce\FrontController@index')->name('front.dashboard');
Route::get('/detail/{id}/{slug}', 'ecommerce\FrontController@detail')->name('front.detail');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');


Route::get('admin/login', 'Auth\AdminAuthController@getLogin')->name('admin.login');
Route::post('admin/login', 'Auth\AdminAuthController@postLogin');
Route::get('admin/logout', 'Auth\AdminAuthController@postLogout')->name('admin.logout');




Route::get('customer/login', 'Auth\CustomerAuthController@getLogin')->name('customer.login');
Route::post('customer/login', 'Auth\CustomerAuthController@postLogin');





Route::middleware('auth:admin')->group(function () {
  Route::get('/home', 'DashboardController@index')->name('home');

  Route::resource('/order', 'OrderController');

  Route::get('/show-trash', 'ProductController@show_trash')->name('product.show_trash');
  Route::delete('/burn/{id}', 'ProductController@burn')->name('product.burn');
  Route::get('/restore/{id}', 'ProductController@restore')->name('product.restore');
  Route::resource('/product', 'ProductController');

  Route::resource('/category', 'CategoryController');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
  Route::get('/add-cart/{id}', 'CartController@add_cart')->name('cart.add');
  Route::post('/update-cart', 'CartController@update_cart')->name('cart.update');
  Route::get('/cart', 'CartController@index')->name('cart');
  Route::delete('/cart-delete/{id}', 'CartController@cart_delete')->name('cart.delete');

  Route::get('/order-list', 'ecommerce\CheckoutController@order_list')->name('order_list');

  Route::get('/checkout', 'ecommerce\CheckoutController@checkout')->name('checkout');
  Route::post('/checkout-process', 'ecommerce\CheckoutController@checkout_process')->name('checkout_process');
  Route::get('/checkout-finish', 'ecommerce\CheckoutController@checkout_finish')->name('checkout_finish');
});


Route::middleware('auth:customer')->group(function () {
  Route::get('customer', 'CustomerController@index')->name('customer.index');
});
