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
        Route::any('index','ArticleController@index');
        Route::any('show','ArticleController@show');
        Route::any('store','ArticleController@store');
        Route::any('update','ArticleController@update');
        Route::any('destroy','ArticleController@destroy');
        Route::any('forceDelete','ArticleController@forceDelete');
    });

    Route::prefix('tag')->group(function(){
        Route::any('index','TagController@index');
        Route::any('show','TagController@show');
        Route::any('store','TagController@store');
        Route::any('update','TagController@update');
        Route::any('destroy','TagController@destroy');
        Route::any('forceDelete','TagController@forceDelete');
    });
});

