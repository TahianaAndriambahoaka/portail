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

Route::controller(administrateur::class)->group(function() {
    Route::get('/administrateur/liste-demandes-inscription', 'demandes_inscription')->middleware('adminSession');
    Route::get('/administrateur/liste-demandes-inscription-{id}', 'demandes_inscription_detail')->where('id', '(.*)')->middleware('adminSession');
    Route::get('/administrateur/deconnexion', 'deconnexion')->middleware('adminSession');
    Route::post('/administrateur/demande-inscription', 'validation_refus_demande_inscription')->middleware('adminSession');
    Route::get('/administrateur/utilisateurs', 'liste_utilisateurs')->middleware('adminSession');
    Route::post('/administrateur/utilisateur/suppression', 'suppression_utilisateur')->middleware('adminSession');
    Route::post('/administrateur/utilisateur/modification-fonction', 'modification_fonction_utilisateur')->middleware('adminSession');
    Route::post('/administrateur/inscription-utilisateur', 'inscription')->middleware('adminSession');
    Route::get('/administrateur/recherche-utilisateurs', 'recherche_utilisateurs')->middleware('adminSession');
    Route::get('/administrateur/mot_de_passe_oublie', 'mot_de_passe_oublie')->middleware('adminSession');
    Route::post('/administrateur/mot_de_passe_oublie/reinitialisation', 'mot_de_passe_oublie_reinitialisation')->middleware('adminSession');
    Route::post('/administrateur/mot_de_passe_oublie/refus', 'mot_de_passe_oublie_refus')->middleware('adminSession');
    Route::get('/administrateur/plateforme-de-discussion', 'plateforme_de_discussion')->middleware('adminSession');
    Route::post('/administrateur/plateforme-de-discussion/publier-sujet', 'publier_sujet')->middleware('adminSession');
    Route::post('/administrateur/plateforme-de-discussion/commenter', 'plateforme_de_discussion_commenter')->middleware('adminSession');
    Route::post('/administrateur/plateforme-de-discussion/ajouter-theme', 'ajouter_theme')->middleware('adminSession');
    Route::post('/administrateur/plateforme-de-discussion/sujet/suppression', 'supprimer_sujet')->middleware('adminSession');
    Route::post('/administrateur/plateforme-de-discussion/sujet/modification', 'modifier_sujet')->middleware('adminSession');
});



Route::controller(utilisateur::class)->group(function() {
    Route::get('/utilisateur/deconnexion', 'deconnexion')->middleware('utilisateurSession');
    Route::post('/ATR/profil/changer-mot-de-passe', 'changer_mot_de_passe')->middleware('utilisateurSession');
    Route::post('/ATR/profil/changer-photo-de-profil', 'changer_photo_de_profil')->middleware('utilisateurSession');
    Route::post('/ATR/modification-de-profil', 'modification_de_profil')->middleware('utilisateurSession');
    Route::get('/ATR/plateforme-de-discussion', 'plateforme_de_discussion')->middleware('utilisateurSession');
    Route::post('/ATR/plateforme-de-discussion/commenter', 'plateforme_de_discussion_commenter')->middleware('utilisateurSession');
    Route::post('/ATR/plateforme-de-discussion/publier-sujet', 'publier_sujet')->middleware('utilisateurSession');

    Route::post('/GCR/profil/changer-mot-de-passe', 'changer_mot_de_passe')->middleware('utilisateurSession');
    Route::post('/GCR/profil/changer-photo-de-profil', 'changer_photo_de_profil')->middleware('utilisateurSession');
    Route::post('/GCR/modification-de-profil', 'modification_de_profil')->middleware('utilisateurSession');
    Route::get('/GCR/plateforme-de-discussion', 'plateforme_de_discussion')->middleware('utilisateurSession');
    Route::post('/GCR/plateforme-de-discussion/commenter', 'plateforme_de_discussion_commenter')->middleware('utilisateurSession');
    Route::post('/GCR/plateforme-de-discussion/publier-sujet', 'publier_sujet')->middleware('utilisateurSession');

    Route::post('/RLS/profil/changer-mot-de-passe', 'changer_mot_de_passe')->middleware('utilisateurSession');
    Route::post('/RLS/profil/changer-photo-de-profil', 'changer_photo_de_profil')->middleware('utilisateurSession');
    Route::post('/RLS/modification-de-profil', 'modification_de_profil')->middleware('utilisateurSession');
    Route::get('/RLS/plateforme-de-discussion', 'plateforme_de_discussion')->middleware('utilisateurSession');
    Route::post('/RLS/plateforme-de-discussion/commenter', 'plateforme_de_discussion_commenter')->middleware('utilisateurSession');
    Route::post('/RLS/plateforme-de-discussion/publier-sujet', 'publier_sujet')->middleware('utilisateurSession');
});

Route::controller(atr::class)->group(function() {
    Route::get('/ATR/profil', 'profil')->middleware('utilisateurSession');
});

Route::controller(gcr::class)->group(function() {
    Route::get('/GCR/profil', 'profil')->middleware('utilisateurSession');
});

Route::controller(rls::class)->group(function() {
    Route::get('/RLS/profil', 'profil')->middleware('utilisateurSession');
});