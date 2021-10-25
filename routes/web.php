<?php

use App\Http\Controllers\pacientesController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('pacientes', [pacientesController::class, 'index']);
Route::get('dadosindex', [pacientesController::class, 'dadosindex']);
Route::post('store', [pacientesController::class, 'store']);

