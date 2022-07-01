<?php

use App\Http\Controllers\administrateur;
use App\Http\Controllers\atr;
use App\Http\Controllers\gcr;
use App\Http\Controllers\rls;
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
Route::get('/oublie-de-mot-de-passe', function () {
    return view('authentification.oublie_de_mot_de_passe');
});
Route::post('/oublie-de-mot-de-passe', [authentification::class, 'oublie_de_mot_de_passe']);

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
Route::get('/administrateur/mot_de_passe_oublie', [administrateur::class, 'mot_de_passe_oublie'])->middleware('adminSession');
Route::post('/administrateur/mot_de_passe_oublie/reinitialisation', [administrateur::class, 'mot_de_passe_oublie_reinitialisation'])->middleware('adminSession');
Route::post('/administrateur/mot_de_passe_oublie/refus', [administrateur::class, 'mot_de_passe_oublie_refus'])->middleware('adminSession');

Route::get('/utilisateur/deconnexion', [utilisateur::class, 'deconnexion'])->middleware('utilisateurSession');

Route::get('/ATR/profil', [atr::class, 'profil'])->middleware('utilisateurSession');
Route::post('/ATR/profil/changer-mot-de-passe', [utilisateur::class, 'changer_mot_de_passe'])->middleware('utilisateurSession');
Route::post('/ATR/profil/changer-photo-de-profil', [utilisateur::class, 'changer_photo_de_profil'])->middleware('utilisateurSession');
Route::post('/ATR/modification-de-profil', [utilisateur::class, 'modification_de_profil'])->middleware('utilisateurSession');

Route::get('/GCR/profil', [gcr::class, 'profil'])->middleware('utilisateurSession');
Route::post('/GCR/profil/changer-mot-de-passe', [utilisateur::class, 'changer_mot_de_passe'])->middleware('utilisateurSession');
Route::post('/GCR/profil/changer-photo-de-profil', [utilisateur::class, 'changer_photo_de_profil'])->middleware('utilisateurSession');
Route::post('/GCR/modification-de-profil', [utilisateur::class, 'modification_de_profil'])->middleware('utilisateurSession');

Route::get('/RLS/profil', [rls::class, 'profil'])->middleware('utilisateurSession');
Route::post('/RLS/profil/changer-mot-de-passe', [utilisateur::class, 'changer_mot_de_passe'])->middleware('utilisateurSession');
Route::post('/RLS/profil/changer-photo-de-profil', [utilisateur::class, 'changer_photo_de_profil'])->middleware('utilisateurSession');
Route::post('/RLS/modification-de-profil', [utilisateur::class, 'modification_de_profil'])->middleware('utilisateurSession');