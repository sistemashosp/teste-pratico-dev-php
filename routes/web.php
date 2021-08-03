<?php

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


Route::get('/', 'HomeController@index')->name('site');

Route::get('/cadastro', 'HomeController@cadastro')->name('cadastro');
Route::post('/cadastro', 'HomeController@cadastroAction');

Route::get('/lista', 'HomeController@lista')->name('lista');


