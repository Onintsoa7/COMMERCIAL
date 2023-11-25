<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OniController;
use App\Http\Controllers\MaheryController;
use App\Http\Controllers\MiradoController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/store_besoin', [OniController::class, 'store_besoin']);
Route::post('/validate_besoin', [OniController::class, 'validate_besoin']);
Route::post('/verification', [OniController::class, 'verification']);
Route::post('/store_proforma', [OniController::class, 'store_proforma']);
Route::get('/proforma',[MaheryController::class,'get_proforma']);
Route::get('/numero_bdc',[MaheryController::class,'generate_number_bdc']);
Route::get('/bdc',[MaheryController::class,'get_bdc']);

// Route::post('/verification', [MiradoController::class, 'verify_login']);

Route::post('/demande_proforma', [MiradoController::class, 'transaction_demande_proforma']);