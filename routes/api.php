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
Route::resource('products', 'ProductController', [
    'only' => ['index', 'show', 'store', 'destroy', 'update']
]);
Route::resource('orders-products', 'OrderProductController');
Route::resource('categories', 'CategorieController', [
    'only' => ['update', 'store', 'show', 'index','destroy']
]);
Route::resource('drivers', 'DriverDataController', [
    'only' => ['update', 'store', 'show', 'index','destroy']
]);
Route::resource('batches', 'BatcheController');
Route::get('trancate-batches', 'BatcheController@troncate');
Route::post('order/{id}/accept', 'OrderController@accept');
Route::get('driver/{id}/gains', 'DriverDataController@gains');
Route::get('driver/{id}/daily-gain', 'DriverDataController@dailyGain');
Route::get('user/{id}/user-orders', 'OrderController@userOrders');
Route::resource('driver-gain', 'DriverGainController', [
    'only' => ['update', 'store', 'show']
]);
Route::get('commerce/{id}/complet-orders', 'OrderController@completOrders');
Route::get('commerce/{id}/pending-orders', 'OrderController@pendingOrders');
Route::get('order/{id}/complet', 'OrderController@completOrder');
Route::resource('message', 'MessageController', [
    'only' => ['update', 'store', 'show', 'index','destroy']
]);
Route::resource('inboxes', 'InboxController', [
    'only' => ['update', 'store', 'show', 'index','destroy']
]);