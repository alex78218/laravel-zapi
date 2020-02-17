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
        Route::get('index','ArticleCOntroller@index');
        Route::get('show','ArticleCOntroller@show');
        Route::get('store','ArticleCOntroller@store');
        Route::get('update','ArticleCOntroller@update');
        Route::get('destroy','ArticleCOntroller@destroy');
    });
});

