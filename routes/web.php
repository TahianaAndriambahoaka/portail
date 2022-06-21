<?php

use App\Http\Controllers\administrateur;
use App\Http\Controllers\authentification;
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
    return view('authentification.login');
});
Route::get('/login', function () {
    return view('authentification.login');
});
Route::post('/login', [authentification::class, 'login']);

Route::get('/inscription', [authentification::class, 'affichage_inscription']);
Route::post('/inscription', [authentification::class, 'inscription']);

Route::get('/administrateur/liste-demandes-inscription', [administrateur::class, 'demandes_inscription'])->middleware('adminSession');
Route::get('/administrateur/liste-demandes-inscription-{id}', [administrateur::class, 'demandes_inscription_detail'])->where('id', '(.*)')->middleware('adminSession');
Route::get('/administrateur/deconnexion', [administrateur::class, 'deconnexion'])->middleware('adminSession');
Route::post('/administrateur/demande-inscription', [administrateur::class, 'validation_refus_demande_inscription'])->middleware('adminSession');
Route::get('/administrateur/utilisateurs', [administrateur::class, 'liste_utilisateurs'])->middleware('adminSession');