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

Route::group(['prefix' => 'auth'], function () {

    Route::get('/login', 'AuthController@login');
    Route::get('/oauth', 'AuthController@oauth');

});

Route::group(['prefix' => 'forex'], function () {

    Route::post('convert', 'ForexController@convert');

});

Route::group(['prefix' => 'dialogflow'], function () {

    Route::post('webhook', 'DialogflowController@webhook');

});
