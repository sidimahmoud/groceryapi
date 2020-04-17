<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware(['auth:api'])->group(function () {
    Route::get('users/current', [
        'as' => 'users.current',
        'uses' => 'UsersController@current'
    ]);
});


Route::resource('users', 'UsersController');
Route::resource('orders', 'OrderController');
Route::resource('markets', 'SuperMarketController');
Route::resource('products', 'ProductController');
Route::resource('orders-products', 'OrderProductController');
Route::resource('categories', 'CategorieController');
Route::resource('drivers', 'DriverDataController', [
    'only' => ['update', 'store', 'show', 'index','destroy']
]);
Route::resource('batches', 'BatcheController');
Route::get('trancate-batches', 'BatcheController@troncate');