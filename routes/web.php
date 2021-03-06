<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::auth();

Route::get('/welcome', function () {
    return view('welcome');
});

Route::prefix('')->namespace('Home')->group(function() {
    Route::get('/','SiteController@index')->name('index');
    Route::get('category/{id}','SiteController@category')->name('category');
    Route::get('tag/{id}','SiteController@tag')->name('tag');
    Route::get('article/{id}','SiteController@article')->name('article');
    Route::get('note','SiteController@note')->name('note');
});
