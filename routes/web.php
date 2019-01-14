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

Auth::routes();

Route::group(['prefix' => 'robo'], function () {
    Route::get('/', 'RoboController@index')->name('robo');
    Route::get('/sendemail', 'RoboController@sendemail')->name('robo.sendemail');
    Route::get('/sendsms', 'RoboController@sendsms')->name('robo.sendsms');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'DashboardController@index')->name('index');
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::group(['prefix' => 'user', 'middleware' => 'auth'], function () {
    Route::get('/', 'UserController@index')->name('user');
    Route::post('/', 'UserController@user')->name('user.store');
    Route::get('/create', 'UserController@create')->name('user.create');
    Route::put('/{id}', 'UserController@update')->name('user.update');
    Route::delete('/{id}', 'UserController@destroy')->name('user.destroy');
    Route::get('/{id}', 'UserController@show')->name('user.show');
    Route::get('/{id}/edit', 'UserController@edit')->name('user.edit');
});

Route::group(['prefix' => 'grupo', 'middleware' => 'auth'], function () {
    Route::get('/', 'GrupoController@index')->name('grupo');
    Route::post('/', 'GrupoController@store')->name('grupo.store');
    Route::get('/create', 'GrupoController@create')->name('grupo.create');
    Route::put('/{id}', 'GrupoController@update')->name('grupo.update');
    Route::delete('/{id}', 'GrupoController@destroy')->name('grupo.destroy');
    Route::get('/{id}', 'GrupoController@show')->name('grupo.show');
    Route::get('/{id}/edit', 'GrupoController@edit')->name('grupo.edit');
});

Route::group(['prefix' => 'client', 'middleware' => 'auth'], function () {
    Route::get('/', 'ClientController@index')->name('client');
    Route::post('/', 'ClientController@store')->name('client.store');
    Route::get('/create', 'ClientController@create')->name('client.create');
    Route::put('/{id}', 'ClientController@update')->name('client.update');
    Route::delete('/{id}', 'ClientController@destroy')->name('client.destroy');
    Route::get('/{id}', 'ClientController@show')->name('client.show');
    Route::get('/{id}/edit', 'ClientController@edit')->name('client.edit');
});

Route::group(['prefix' => 'emailcampanha', 'middleware' => 'auth'], function () {
    Route::get('/', 'EmailcampanhaController@index')->name('emailcampanha');
    Route::post('/', 'EmailcampanhaController@store')->name('emailcampanha.store');
    Route::get('/create', 'EmailcampanhaController@create')->name('emailcampanha.create');
    Route::put('/{id}', 'EmailcampanhaController@update')->name('emailcampanha.update');
    Route::delete('/{id}', 'EmailcampanhaController@destroy')->name('emailcampanha.destroy');
    Route::get('/{id}', 'EmailcampanhaController@show')->name('emailcampanha.show');
    Route::get('/{id}/edit', 'EmailcampanhaController@edit')->name('emailcampanha.edit');
    Route::post('/listar', 'EmailcampanhaController@listar')->name('emailcampanha.listar');
});

Route::group(['prefix' => 'smscampanha', 'middleware' => 'auth'], function () {
    Route::get('/', 'SmscampanhaController@index')->name('smscampanha');
    Route::post('/', 'SmscampanhaController@store')->name('smscampanha.store');
    Route::get('/create', 'SmscampanhaController@create')->name('smscampanha.create');
    Route::put('/{id}', 'SmscampanhaController@update')->name('smscampanha.update');
    Route::delete('/{id}', 'SmscampanhaController@destroy')->name('smscampanha.destroy');
    Route::get('/{id}', 'SmscampanhaController@show')->name('smscampanha.show');
    Route::get('/{id}/edit', 'SmscampanhaController@edit')->name('smscampanha.edit');
    Route::post('/listar', 'SmscampanhaController@listar')->name('smscampanha.listar');
});


Route::group(['prefix' => 'emailserver', 'middleware' => 'auth'], function () {
    Route::get('/', 'EmailserverController@index')->name('emailserver');
    Route::post('/', 'EmailserverController@store')->name('emailserver.store');
    Route::get('/create', 'EmailserverController@create')->name('emailserver.create');
    Route::put('/{id}', 'EmailserverController@update')->name('emailserver.update');
    Route::delete('/{id}', 'EmailserverController@destroy')->name('emailserver.destroy');
    Route::get('/{id}', 'EmailserverController@show')->name('emailserver.show');
    Route::get('/{id}/edit', 'EmailserverController@edit')->name('emailserver.edit');
});


Route::group(['prefix' => 'smsserver', 'middleware' => 'auth'], function () {
    Route::get('/', 'SmsserverController@index')->name('smsserver');
    Route::post('/', 'SmsserverController@store')->name('smsserver.store');
    Route::get('/create', 'SmsserverController@create')->name('smsserver.create');
    Route::put('/{id}', 'SmsserverController@update')->name('smsserver.update');
    Route::delete('/{id}', 'SmsserverController@destroy')->name('smsserver.destroy');
    Route::get('/{id}', 'SmsserverController@show')->name('smsserver.show');
    Route::get('/{id}/edit', 'SmsserverController@edit')->name('smsserver.edit');
});