<?php

namespace App\Http\Controllers;

use App\Models\demande_inscription;
use App\Models\district;
use Illuminate\Http\Request;
use App\Models\fonction;
use App\Models\region;
use App\Models\utilisateur;
use Illuminate\Support\Facades\Session;
use App\Models\login;

class administrateur extends Controller
{
    public function demandes_inscription() {
        $demandes_inscription = demande_inscription::getAll();
        $fonctions = [];
        $regions = [];
        $districts = [];
        for ($i=0; $i < count($demandes_inscription); $i++) { 
            $fonctions[] = fonction::getById($demandes_inscription[$i]->id_fonction)[0];
            $regions[] = region::getById($demandes_inscription[$i]->id_region)[0];
            $districts[] = district::getById($demandes_inscription[$i]->id_district)[0];
        }
        return view('admin.demandes_inscription', ["demandes_inscription" => $demandes_inscription, "fonctions" => $fonctions, "regions" => $regions, "districts" => $districts]);
    }

    public function validation_refus_demande_inscription(Request $request) {
        $id_demande_inscription = $request->input('id_demande_inscription');
        try {
            if ($request->input('valider') != null) {
                demande_inscription::valider($id_demande_inscription);
                return back()->with('success', "Demande d'inscription validée!");
            } else {
                demande_inscription::refuser($id_demande_inscription);
                return back()->with('success', "Demande d'inscription refusée!");
            }
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
    public function deconnexion() {
        Session::forget('administrateur');
        return view('authentification.login');
    }
    public function liste_utilisateurs() {
        $utilisateurs = utilisateur::getAll();
        $fonctions = [];
        $regions = [];
        $districts = [];
        for ($i=0; $i < count($utilisateurs); $i++) {
            $login = login::getByIdUtilisateur($utilisateurs[$i]->id)[0];
            $fonctions[] = fonction::getById($login->id_fonction)[0];
            $regions[] = region::getById($utilisateurs[$i]->id_region)[0];
            $districts[] = district::getById($utilisateurs[$i]->id_district)[0];
        }
        return view('admin.liste_utilisateurs', ['utilisateurs'=>$utilisateurs, 'fonctions'=>$fonctions, "regions" => $regions, "districts" => $districts, 'allFonctions'=>fonction::getAll()]);
    }
}
