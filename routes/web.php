<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OniController;
use App\Http\Controllers\MiradoController;
use App\Http\Controllers\MaheryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/pdf',[MaheryController::class,'generatePDF']);
Route::get('/departement', [OniController::class, 'departement']);
Route::get('/articles', [OniController::class, 'articles']);
Route::get('/categorie_article', [OniController::class, 'categorie_article']);
Route::get('/article_by_categorie', [OniController::class, 'article_by_categorie']);
Route::get('/',[OniController::class, 'index']);
Route::get('/login', [OniController::class, 'login']);
Route::get('/disconnect', [OniController::class, 'disconnect']);
Route::get('/demande_liste', [OniController::class, 'demande_liste']);
Route::get('/demande_liste_detail/{id_dept_demande}', [OniController::class, 'demande_liste_detail']);
Route::get('/validate_besoin/{id_dept_demande}', [OniController::class, 'validate_besoin']);
Route::get('/saisi_proforma', [OniController::class, 'saisi_proforma']);
Route::get('/categoriesByFournisseur', [OniController::class,'categoriesByFournisseur']);
Route::get('/proforma',[MaheryController::class,'get_proforma']);


Route::get('/demande_hebdo',[MiradoController::class,'demande_hebdo']);
Route::get('/voir-detail/{semaine}/{mois}/{annee}', [MiradoController::class,'liste_demande'])->name('voir-detail');

