<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminAuthMiddleware;
use App\Http\Controllers\CartController;

Route::get('/', 'App\Http\Controllers\HomeController@index')->name("home.index");



Route::get('/product', 'App\Http\Controllers\ProductController@index')->name("product.index");
Route::get('/product/{id}', 'App\Http\Controllers\ProductController@show')->name("product.show");

Route::get('/cartProduct', 'App\Http\Controllers\CartProductController@index')->name("cart.product.index");
Route::get('/cartProduct/delete', 'App\Http\Controllers\CartProductController@delete')->name("cart.product.delete");
Route::post('/cartProduct/add/{id}', 'App\Http\Controllers\CartProductController@add')->name("cart.product.add");

Route::get('/service', 'App\Http\Controllers\ServiceController@index')->name("service.index");
Route::get('/service/{id}', 'App\Http\Controllers\ServiceController@show')->name("service.show");

Route::get('/cartService', 'App\Http\Controllers\CartServiceController@index')->name("cart.service.index");
Route::get('/cartService/delete', 'App\Http\Controllers\CartServiceController@delete')->name("cart.service.delete");
Route::post('/cartService/add/{id}', 'App\Http\Controllers\CartServiceController@add')->name("cart.service.add");


Route::middleware('auth')->group(function () {
    Route::get('/cartProduct/purchase', 'App\Http\Controllers\CartProductController@purchase')->name("cart.product.purchase");
    Route::get('/cartService/purchase', 'App\Http\Controllers\CartServiceController@purchase')->name("cart.service.purchase");
    Route::get('/my-account/orderProduct', 'App\Http\Controllers\MyAccountController@orderProduct')->name("myaccount.order_product");
    Route::get('/my-account/orderService', 'App\Http\Controllers\MyAccountController@orderService')->name("myaccount.order_service");
});

Route::middleware([AdminAuthMiddleware::class])->group(function () {
    Route::get('/admin', 'App\Http\Controllers\Admin\AdminHomeController@index')->name("admin.home.index");

    Route::get('/admin/product', 'App\Http\Controllers\Admin\AdminProductController@index')->name("admin.product.index");
    Route::post('/admin/product/store', 'App\Http\Controllers\Admin\AdminProductController@store')->name("admin.product.store");
    Route::get('/admin/product/{id}/edit', 'App\Http\Controllers\Admin\AdminProductController@edit')->name("admin.product.edit");
    Route::put('/admin/product/{id}/update', 'App\Http\Controllers\Admin\AdminProductController@update')->name("admin.product.update");
    Route::delete('/admin/product/{id}/delete', 'App\Http\Controllers\Admin\AdminProductController@delete')->name("admin.product.delete");

    Route::get('/admin/service', 'App\Http\Controllers\Admin\AdminServiceController@index')->name("admin.service.index");
    Route::post('/admin/service/store', 'App\Http\Controllers\Admin\AdminServiceController@store')->name("admin.service.store");
    Route::get('/admin/service/{id}/edit', 'App\Http\Controllers\Admin\AdminServiceController@edit')->name("admin.service.edit");
    Route::put('/admin/service/{id}/update', 'App\Http\Controllers\Admin\AdminServiceController@update')->name("admin.service.update");
    Route::delete('/admin/service/{id}/delete', 'App\Http\Controllers\Admin\AdminServiceController@delete')->name("admin.service.delete");
});

Auth::routes();
