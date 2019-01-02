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

Route::get('/utility/listarprocedimentos', 'UtilityController@listarprocedimentos')->name('listarprocedimentos');
Route::get('/utility/listarmatmeds', 'UtilityController@listarmatmeds')->name('listarmatmeds');

Route::group(['prefix' => 'user', 'middleware' => 'auth'], function () {
    Route::get('/', 'UserController@index')->name('user');
    Route::post('/', 'UserController@user')->name('user.store');
    Route::get('/create', 'UserController@create')->name('user.create');
    Route::put('/{id}', 'UserController@update')->name('user.update');
    Route::delete('/{id}', 'UserController@destroy')->name('user.destroy');
    Route::get('/{id}', 'UserController@show')->name('user.show');
    Route::get('/{id}/edit', 'UserController@edit')->name('user.edit');
});

Route::group(['prefix' => 'procedimento', 'middleware' => 'auth'], function () {
    Route::get('/', 'ProcedimentoController@index')->name('procedimento');
    Route::post('/', 'ProcedimentoController@store')->name('procedimento.store');
    Route::get('/create', 'ProcedimentoController@create')->name('procedimento.create');
    Route::put('/{id}', 'ProcedimentoController@update')->name('procedimento.update');
    Route::delete('/{id}', 'ProcedimentoController@destroy')->name('procedimento.destroy');
    Route::get('/{id}', 'ProcedimentoController@show')->name('procedimento.show');
    Route::get('/{id}/edit', 'ProcedimentoController@edit')->name('procedimento.edit');
    Route::post('/listar', 'ProcedimentoController@listar')->name('procedimento.listar');
});

Route::group(['prefix' => 'tprocedimento', 'middleware' => 'auth'], function () {
    Route::get('/', 'TprocedimentoController@index')->name('tprocedimento');
    Route::post('/', 'TprocedimentoController@store')->name('tprocedimento.store');
    Route::get('/create', 'TprocedimentoController@create')->name('tprocedimento.create');
    Route::put('/{id}', 'TprocedimentoController@update')->name('tprocedimento.update');
    Route::delete('/{id}', 'TprocedimentoController@destroy')->name('tprocedimento.destroy');
    Route::get('/{id}', 'TprocedimentoController@show')->name('tprocedimento.show');
    Route::get('/{id}/edit', 'TprocedimentoController@edit')->name('tprocedimento.edit');
});

Route::group(['prefix' => 'tmatmed', 'middleware' => 'auth'], function () {
    Route::get('/', 'TmatmedController@index')->name('tmatmed');
    Route::post('/', 'TmatmedController@store')->name('tmatmed.store');
    Route::get('/create', 'TmatmedController@create')->name('tmatmed.create');
    Route::put('/{id}', 'TmatmedController@update')->name('tmatmed.update');
    Route::delete('/{id}', 'TmatmedController@destroy')->name('tmatmed.destroy');
    Route::get('/{id}', 'TmatmedController@show')->name('tmatmed.show');
    Route::get('/{id}/edit', 'TmatmedController@edit')->name('tmatmed.edit');
});

Route::group(['prefix' => 'fabricante', 'middleware' => 'auth'], function () {
    Route::get('/', 'FabricanteController@index')->name('fabricante');
    Route::post('/', 'FabricanteController@store')->name('fabricante.store');
    Route::get('/create', 'FabricanteController@create')->name('fabricante.create');
    Route::put('/{id}', 'FabricanteController@update')->name('fabricante.update');
    Route::delete('/{id}', 'FabricanteController@destroy')->name('fabricante.destroy');
    Route::get('/{id}', 'FabricanteController@show')->name('fabricante.show');
    Route::get('/{id}/edit', 'FabricanteController@edit')->name('fabricante.edit');
});

Route::group(['prefix' => 'especialidade', 'middleware' => 'auth'], function () {
    Route::get('/', 'EspecialidadeController@index')->name('especialidade');
    Route::post('/', 'EspecialidadeController@store')->name('especialidade.store');
    Route::get('/create', 'EspecialidadeController@create')->name('especialidade.create');
    Route::put('/{id}', 'EspecialidadeController@update')->name('especialidade.update');
    Route::delete('/{id}', 'EspecialidadeController@destroy')->name('especialidade.destroy');
    Route::get('/{id}', 'EspecialidadeController@show')->name('especialidade.show');
    Route::get('/{id}/edit', 'EspecialidadeController@edit')->name('especialidade.edit');
});

Route::group(['prefix' => 'matmed', 'middleware' => 'auth'], function () {
    Route::get('/', 'MatmedController@index')->name('matmed');
    Route::post('/', 'MatmedController@store')->name('matmed.store');
    Route::get('/create', 'MatmedController@create')->name('matmed.create');
    Route::put('/{id}', 'MatmedController@update')->name('matmed.update');
    Route::delete('/{id}', 'MatmedController@destroy')->name('matmed.destroy');
    Route::get('/{id}', 'MatmedController@show')->name('matmed.show');
    Route::get('/{id}/edit', 'MatmedController@edit')->name('matmed.edit');
    Route::post('/listar', 'MatmedController@listar')->name('matmed.listar');
});

Route::group(['prefix' => 'kit', 'middleware' => 'auth'], function () {
    Route::get('/', 'KitController@index')->name('kit');
    Route::post('/', 'KitController@store')->name('kit.store');
    Route::get('/create', 'KitController@create')->name('kit.create');
    Route::put('/{id}', 'KitController@update')->name('kit.update');
    Route::delete('/{id}', 'KitController@destroy')->name('kit.destroy');
    Route::get('/{id}', 'KitController@show')->name('kit.show');
    Route::get('/{id}/edit', 'KitController@edit')->name('kit.edit');
});

Route::group(['prefix' => 'validarxml', 'middleware' => 'auth'], function () {
    Route::get('/', 'ValidarxmlController@index')->name('validarxml');
    Route::post('/', 'ValidarxmlController@validar')->name('validarxml.validar');
    Route::post('/baixarxml', 'ValidarxmlController@baixarxml')->name('validarxml.baixarxml');
    Route::post('/baixarzip', 'ValidarxmlController@baixarzip')->name('validarxml.baixarzip');
});
