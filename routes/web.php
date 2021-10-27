<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'web'], function () {
    Route::get('/', 'HomeController@index');

    Route::get('pacientes/cadastro', 'PacientesController@cadastro')->name('cadastro');
    Route::get('/pacientes', 'PacientesController@index')->name('index');
    Route::get('/tiposanguineo', 'TipoSanguineoController@index')->name('indextiposanguineo');

    // Route::get('pacientes/importar', 'PacientesController@importar')->name('importar');

    Auth::routes();
    Route::get('/home', 'HomeController@index')->name('home');    
});

