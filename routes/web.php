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
