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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('user')->group(function () {
    Route::get('/','API\UserController@index')->name('user.index');
    Route::post('login','API\UserController@login')->name('user.login');
});


Route::apiResource('product', 'API\Product\ProductController');
Route::prefix('product')->group(function(){
    Route::apiResource('{product}/review', 'API\Product\ReviewController');
});

