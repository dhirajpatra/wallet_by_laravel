<?php

use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
// 	return $request->user();
// });

Route::post('login', 'PassportController@login');
Route::post('register', 'PassportController@register');

Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function () {

	Route::get('user', 'PassportController@details');

	Route::get('wallets', 'WalletController@index');
	Route::post('wallets', 'WalletController@store');
	Route::get('wallets/{id}', 'WalletController@show');
	Route::put('wallets/{id}', 'WalletController@update');
	Route::delete('wallets/{id}', 'WalletController@remove');

	Route::get('records', 'RecordController@index');
	Route::post('records', 'RecordController@create');
	Route::get('records/{id}', 'RecordController@show');
	Route::put('records/{id}', 'RecordController@update');
	Route::delete('records/{id}', 'RecordController@remove');

});