<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\AdminAuthMiddleware;

Route::get('/', 'App\Http\Controllers\HomeController@index')->name("home.index");

Route::get('/product', 'App\Http\Controllers\ProductController@index')->name("product.index");
Route::get('/product/{id}', 'App\Http\Controllers\ProductController@show')->name("product.show");

Route::get('/cart', 'App\Http\Controllers\CartController@index')->name("cart.index");
Route::get('/cart/delete', 'App\Http\Controllers\CartController@delete')->name("cart.delete");
Route::post('/cart/add/{id}', 'App\Http\Controllers\CartController@add')->name("cart.add");

Route::get('/service', 'App\Http\Controllers\ServiceController@index')->name("service.index");
Route::get('/service/{id}', 'App\Http\Controllers\ServiceController@show')->name("service.show");

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
