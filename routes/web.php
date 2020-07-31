<?php

use Illuminate\Support\Facades\Auth;
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



Auth::routes();


Route::get('admin/dashboard', 'HomeController@index')->name('home');

Route::get('/','FrontendController@index')->name('frontend.index');
Route::get('shop', 'FrontendController@shop')->name('frontend.shop');
Route::get('product/details/{id}','FrontendController@productDetails')->name('frontend.product.details');
Route::get('category/product/{id}', 'FrontendController@showProductsByCategory')->name('frontend.products_show');

//Cart Routes
Route::post('cart/product/add/','CartController@addToCart')->name('add_to_cart');
Route::get('cart/product/remove/{id}','CartController@cartProductRemove')->name('cart_product_remove');
Route::post('cart/product/update/', 'CartController@cartProductUpdate')->name('cart_product_update');

//Checkout_form
Route::get('checkout/customer','CheckoutController@checkout')->name('checkout_form');
Route::post('checkout/customer/sign', 'CheckoutController@customerSign')->name('customer.save');
Route::get('/customer/product/shipping', 'CheckoutController@productShipping')->name('product.shipping');
Route::post('/customer/product/shipping/save', 'CheckoutController@saveShipping')->name('product.shipping.save');
Route::get('/customer/product/checkout/payment', 'CheckoutController@checkoutPayment')->name('checkout.payment');
Route::post('/customer/product/order', 'CheckoutController@orderSave')->name('order.save');
Route::get('/customer/logout', 'CheckoutController@customerLogout')->name('customer.logout');
Route::post('/customer/login', 'CheckoutController@customerLogin')->name('customer.login');

//Admin Routes
    Route::group(['prefix' => 'admin','as'=>'admin.','namespace'=>'Admin','middleware'=>'auth'], function () {
    //Category
    Route::resource('category', 'CategoryController');
    Route::post('admin/category/publish/{id}', 'CategoryController@publish')->name('category.publish');
    Route::post('admin/category/unpublish/{id}', 'CategoryController@unpublish')->name('category.unpublish');

    //Product
    Route::resource('product', 'ProductController');
    Route::post('admin/product/publish/{id}', 'ProductController@publish')->name('product.publish');
    Route::post('admin/product/unpublish/{id}', 'ProductController@unpublish')->name('product.unpublish');
    Route::post('admin/product/restore/{id}', 'ProductController@restore')->name('product.restore');
    Route::delete('admin/product/force delete/{id}', 'ProductController@forceDelete')->name('product.forceDelete');

    //Order
    Route::get('admin/order/view','OrderController@index')->name('order.index');
    Route::get('admin/order/details/{id}', 'OrderController@details')->name('order.details');
    Route::get('admin/order/invoice/{id}', 'OrderController@invoice')->name('order.invoice.show');
    Route::get('admin/order/invoice/download/{id}', 'OrderController@invoiceDownload')->name('order.invoice.download');
});
