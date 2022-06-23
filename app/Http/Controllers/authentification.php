<?php

namespace App\Http\Controllers;

use App\Models\demande_inscription;
use App\Models\district;
use App\Models\fonction;
use App\Models\region;
use App\Models\utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Image;
use App\Models\login;

class authentification extends Controller
{
    public function login(Request $request) {
        $adresse_mail = $request->input('adresse_mail');
        $mot_de_passe = $request->input('mot_de_passe');
        $auth = login::connexion($adresse_mail, $mot_de_passe);
        if (count($auth) > 0) {
            $nb = count($auth);
            if ($auth[$nb-1] == 'admin') {
                Session::put('administrateur', $auth[0]);
                return redirect('/administrateur/liste-demandes-inscription');
            } else {
                $login = $auth[0];
                Session::put('id_utilisateur', $login->id_utilisateur);
                Session::put('id_login', $login->id);
                $id_fonction = $login->id_fonction;
                $fonctions = fonction::getAll();
                for ($i=0; $i < count($fonctions); $i++) { 
                    if ($fonctions[$i]->id == $id_fonction) {
                        if ($fonctions[$i]->nom == 'ATR') {
                            return redirect('/ATR/profil');
                        } elseif ($fonctions[$i]->nom == 'GCR') {
                            return view('gcr.profil', ['allRegions'=>region::getAll(), 'allDistricts'=>district::getAll(), 'allFonctions'=>fonction::getAll()]);
                        } elseif ($fonctions[$i]->nom == 'RLS') {
                            return view('rls.profil', ['allRegions'=>region::getAll(), 'allDistricts'=>district::getAll(), 'allFonctions'=>fonction::getAll()]);
                        } else {
                            return back()->with('error',"Une erreur s'est produite!");
                        }
                    }
                }
                // $utilisateur = utilisateur::getById($login->id_utilisateur);
                return back()->with('error',"Adresse mail ou mot de passe incorrect!");
            }
        } else {
            return back()->with('error',"Adresse mail ou mot de passe incorrect!");
        }
    }
    public function affichage_inscription() {

        try {
            return view('authentification.inscription', ['region'=>region::getAll(), 'district'=>district::getAll(), 'fonction'=>fonction::getAll()]);
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    public function inscription(Request $request) {
        $nom = trim($request->input('nom'));
        $prenom = trim($request->input('prenom'));
        $email = trim($request->input('email'));
        $telephone1 = trim($request->input('telephone1'));
        $telephone2 = trim($request->input('telephone2'));
        $telephone3 = trim($request->input('telephone3'));
        $id_district = trim($request->input('id_district'));
        $id_region = trim($request->input('id_region'));
        $ministere = trim($request->input('ministere'));
        $direction = trim($request->input('direction'));
        $lieu_de_travail = trim($request->input('lieu_de_travail'));
        $photo_de_profil = 'default_profile_picture.jpg';
        $id_fonction = $_POST['id_fonction'];
        if ($request->hasFile('profile_photo')) {
            $this->validate($request, [
                'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            ]);
            $image = $request->file('profile_photo');
            $photo_de_profil = $image->getClientOriginalName();
            $photo_de_profil = md5($photo_de_profil.time());
            $photo_de_profil = $photo_de_profil.'.'.$image->getClientOriginalExtension();
            // $image->move(public_path().'/images/photo_de_profil/', $photo_de_profil);

            $destinationPath = public_path('images/photo_de_profil');
            $img = Image::make($image->getRealPath());
            $img->resize(150, 150, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$photo_de_profil);
        }
        try {
            demande_inscription::add($nom, $prenom, $email, $telephone1, $telephone2, $telephone3, $id_district, $id_region, $ministere, $direction, $lieu_de_travail, $photo_de_profil, $id_fonction, date('y-m-d'));
            return back()->with('success',"Demande d'inscription envoyée avec succès!");
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
        // return view('authentification.inscription', ['region'=>region::getAll(), 'district'=>district::getAll(), 'fonction'=>fonction::getAll()]);
    }
}
