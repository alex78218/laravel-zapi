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
        Route::any('store','ArticleController@store');
        Route::any('update/{id}','ArticleController@update');
        Route::get('show/{id}','ArticleController@show');
        Route::any('destroy/{id}','ArticleController@destroy');
        Route::any('forceDelete/{id}','ArticleController@forceDelete');
    });

    Route::prefix('tag')->group(function(){
        Route::any('index','TagController@index');
        Route::any('store','TagController@store');
        Route::any('update/{id}','TagController@update');
        Route::any('show/{id}','TagController@show');
        Route::any('destroy/{id}','TagController@destroy');
        Route::any('forceDelete/{id}','TagController@forceDelete');
    });
});

