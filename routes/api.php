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

Route::prefix('')->namespace('Admin')->group(function(){
    Route::prefix('article')->group(function(){
        Route::get('index','ArticleController@index');
        Route::get('show','ArticleController@show');
        Route::get('store','ArticleController@store');
        Route::get('update','ArticleController@update');
        Route::get('destroy','ArticleController@destroy');
    });

    Route::prefix('tag')->group(function(){
        Route::get('index','TagController@index');
        Route::get('show','TagController@show');
        Route::get('store','TagController@store');
        Route::get('update','TagController@update');
        Route::get('destroy','TagController@destroy');
    });
});

