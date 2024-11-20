<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/products', 'App\Http\Controllers\Api\ProductApiController@index')->name('api.products.index');
Route::get('/products/{id}', 'App\Http\Controllers\Api\ProductApiController@show')->name('api.products.show');
Route::get('/exchange-rate', 'App\Http\Controllers\Api\CurrencyApiController@getExchangeRate')->name('api.exchange-rate');
