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

Route::middleware('auth.api')->namespace('Admin')->group(function(){
    Route::prefix('auth')->group(function(){
        Route::any('login', 'AuthController@login');
        Route::any('logout', 'AuthController@logout');
        Route::any('refresh', 'AuthController@refresh');
        Route::any('me', 'AuthController@me')->name('auth.me');
    });
});

Route::prefix('')->namespace('Admin')->group(function(){
    Route::prefix('article')->group(function(){
        Route::any('index','ArticleController@index');
        Route::any('store','ArticleController@store');
        Route::any('show/{id}','ArticleController@show');
        Route::any('update/{id}','ArticleController@update');
        Route::any('destroy/{id}','ArticleController@destroy');
        Route::any('forceDelete/{id}','ArticleController@forceDelete');
    });

    Route::prefix('tag')->group(function(){
        Route::any('index','TagController@index');
        Route::any('store','TagController@store');
        Route::any('show/{id}','TagController@show');
        Route::any('update/{id}','TagController@update');
        Route::any('destroy/{id}','TagController@destroy');
        Route::any('forceDelete/{id}','TagController@forceDelete');
    });

    Route::prefix('category')->group(function(){
        Route::any('index','CategoryController@index');
        Route::any('store','CategoryController@store');
        Route::any('show/{id}','CategoryController@show');
        Route::any('update/{id}','CategoryController@update');
        Route::any('destroy/{id}','CategoryController@destroy');
        Route::any('forceDelete/{id}','CategoryController@forceDelete');
    });

    Route::prefix('user')->group(function(){
        Route::any('index','UserController@index');
        Route::any('store','UserController@store');
        Route::any('show/{id}','UserController@show');
        Route::any('update/{id}','UserController@update');
        Route::any('destroy/{id}','UserController@destroy');
        Route::any('forceDelete/{id}','UserController@forceDelete');
    });

    Route::prefix('role')->group(function(){
        Route::any('test','RoleController@test');
        Route::any('index','RoleController@index');
        Route::any('store','RoleController@store');
        Route::any('show/{id}','RoleController@show');
        Route::any('update/{id}','RoleController@update');
        Route::any('destroy/{id}','RoleController@destroy');
        Route::any('forceDelete/{id}','RoleController@forceDelete');
    });
});
