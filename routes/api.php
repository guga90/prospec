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

Route::group(['prefix' => 'robo'], function () {
    Route::get('/', 'RoboController@index')->name('robo');
    Route::get('/sendemail', 'RoboController@sendemail')->name('robo.sendemail');
    Route::get('/sendsms', 'RoboController@sendsms')->name('robo.sendsms');
});
