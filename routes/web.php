<?php

use App\Http\Controllers\administrateur;
use App\Http\Controllers\atr;
use App\Http\Controllers\authentification;
use App\Http\Controllers\utilisateur;
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
Route::post('/administrateur/utilisateur/suppression', [administrateur::class, 'suppression_utilisateur'])->middleware('adminSession');
Route::post('/administrateur/utilisateur/modification-fonction', [administrateur::class, 'modification_fonction_utilisateur'])->middleware('adminSession');
Route::post('/administrateur/inscription-utilisateur', [administrateur::class, 'inscription'])->middleware('adminSession');
Route::get('/administrateur/utilisateursWS', [administrateur::class, 'utilisateursWS'])->middleware('adminSession');

Route::get('/ATR/profil', [atr::class, 'profil'])->middleware('utilisateurSession');
Route::get('/utilisateur/deconnexion', [utilisateur::class, 'deconnexion'])->middleware('utilisateurSession');