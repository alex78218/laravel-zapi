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
        Route::any('login', 'AuthController@login')->name('auth.login');
        Route::any('logout', 'AuthController@logout')->name('auth.logout');
        Route::any('refresh', 'AuthController@refresh')->name('auth.refresh');
        Route::any('me', 'AuthController@me')->name('auth.me')->name('auth.me');
    });
});

Route::prefix('')->namespace('Admin')->group(function(){
    Route::prefix('article')->group(function(){
        Route::any('index','ArticleController@index')->name('article.index');
        Route::any('store','ArticleController@store')->name('article.store');
        Route::any('show/{id}','ArticleController@show')->name('article.show');
        Route::any('update/{id}','ArticleController@update')->name('article.update');
        Route::any('destroy/{id}','ArticleController@destroy')->name('article.destroy');
        Route::any('forceDelete/{id}','ArticleController@forceDelete')->name('article.forceDelete');
    });

    Route::prefix('tag')->group(function(){
        Route::any('index','TagController@index')->name('tag.index');
        Route::any('all','TagController@all')->name('tag.all');
        Route::any('store','TagController@store')->name('tag.store');
        Route::any('show/{id}','TagController@show')->name('tag.show');
        Route::any('update/{id}','TagController@update')->name('tag.update');
        Route::any('destroy/{id}','TagController@destroy')->name('tag.destroy');
        Route::any('forceDelete/{id}','TagController@forceDelete')->name('tag.forceDelete');
    });

    Route::prefix('category')->group(function(){
        Route::any('index','CategoryController@index')->name('category.index');
        Route::any('all','CategoryController@all')->name('category.all');
        Route::any('store','CategoryController@store')->name('category.store');
        Route::any('show/{id}','CategoryController@show')->name('category.show');
        Route::any('update/{id}','CategoryController@update')->name('category.update');
        Route::any('destroy/{id}','CategoryController@destroy')->name('category.destroy');
        Route::any('forceDelete/{id}','CategoryController@forceDelete')->name('category.forceDelete');
    });

    Route::prefix('user')->group(function(){
        Route::any('index','UserController@index')->name('user.index');
        Route::any('store','UserController@store')->name('user.store');
        Route::any('show/{id}','UserController@show')->name('user.show');
        Route::any('update/{id}','UserController@update')->name('user.update');
        Route::any('destroy/{id}','UserController@destroy')->name('user.destroy');
        Route::any('forceDelete/{id}','UserController@forceDelete')->name('user.forceDelete');
    });

    Route::prefix('role')->group(function(){
        Route::any('test','RoleController@test')->name('role.test');
        Route::any('index','RoleController@index')->name('role.index');
        Route::any('store','RoleController@store')->name('role.store');
        Route::any('show/{id}','RoleController@show')->name('role.show');
        Route::any('update/{id}','RoleController@update')->name('role.update');
        Route::any('destroy/{id}','RoleController@destroy')->name('role.destroy');
        Route::any('forceDelete/{id}','RoleController@forceDelete')->name('role.forceDelete');
    });

    Route::prefix('file')->group(function(){
        Route::post('upload','FileController@upload')->name('file.upload');
    });

    Route::any('test','TestController@index')->name('test.index');
});
