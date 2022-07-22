<?php

namespace App\Http\Controllers;

use App\Models\admin;
use App\Models\demande_inscription;
use App\Models\district;
use Illuminate\Http\Request;
use App\Models\fonction;
use App\Models\region;
use App\Models\utilisateur;
use Illuminate\Support\Facades\Session;
use App\Models\login;
use App\Models\ministere;
use App\Models\utilisateur_supprime;
use Illuminate\Support\Str;
use Mail;
use Illuminate\Support\Facades\DB;
use App\Models\mot_de_passe_oublie;
use App\Models\theme;
use App\Models\sujet;
use App\Models\commentaire;
use App\Models\personne;
use Pusher;

class administrateur extends Controller
{
    public function modifier_sujet(request $request) {
        try {
            $id_sujet = $request->input('id_sujet');
            $sujet = $request->input('sujet');
            sujet::updateById($id_sujet, $sujet);
            return back()->with('success', "Sujet modifié!");
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
    public function supprimer_sujet(request $request) {
        try {
            $id_sujet = $request->input('id_sujet');
            sujet::deleteById($id_sujet);
            return back()->with('success', "Sujet supprimé!");
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
    public function mot_de_passe_oublie() {
        $mot_de_passe_oublie = mot_de_passe_oublie::getAll(5);
        $utilisateurs = [];
        $fonctions = [];
        $regions = [];
        $districts = [];
        for ($i=0; $i < count($mot_de_passe_oublie); $i++) {
            $utilisateur = utilisateur::getByNomPrenomEmail($mot_de_passe_oublie[$i]->nom, $mot_de_passe_oublie[$i]->prenom, $mot_de_passe_oublie[$i]->email)[0];
            $utilisateurs[] = $utilisateur;
            $login = login::getByIdUtilisateur($utilisateur->id)[0];
            $fonctions[] = fonction::getById($login->id_fonction)[0];
            $regions[] = region::getById($utilisateur->id_region)[0];
            $districts[] = district::getById($utilisateur->id_district)[0];
        }
        return view('admin.mot_de_passe_oublie', ['mot_de_passe_oublie'=>$mot_de_passe_oublie, 'utilisateurs'=>$utilisateurs, 'fonctions'=>$fonctions, "regions" => $regions, "districts" => $districts, 'allFonctions'=>fonction::getAll(), 'allRegions'=>region::getAll(), 'allDistricts'=>district::getAll(), 'allMinisteres'=>ministere::getAll()]);
    }
    public function demandes_inscription() {
        $demandes_inscription = demande_inscription::getAll(5);
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
    public function liste_utilisateurs(Request $request) {
        $fonction = $request->input('fonction');
        $utilisateurs = utilisateur::getAll($fonction, 5);
        $fonctions = [];
        $regions = [];
        $districts = [];
        for ($i=0; $i < count($utilisateurs); $i++) {
            $login = login::getByIdUtilisateur($utilisateurs[$i]->id)[0];
            $fonctions[] = fonction::getById($login->id_fonction)[0];
            $regions[] = region::getById($utilisateurs[$i]->id_region)[0];
            $districts[] = district::getById($utilisateurs[$i]->id_district)[0];
        }
        return view('admin.liste_utilisateurs', ['utilisateurs'=>$utilisateurs, 'fonctions'=>$fonctions, "regions" => $regions, "districts" => $districts, 'allFonctions'=>fonction::getAll(), 'allRegions'=>region::getAll(), 'allDistricts'=>district::getAll(), 'allMinisteres'=>ministere::getAll()]);
    }
    public function suppression_utilisateur(Request $request) {
        try {
            $id_utilisateur = $request->input('id_utilisateur');
            $motif = $request->input('motif');
            $id_login = login::getByIdUtilisateur($id_utilisateur)[0]->id;
            utilisateur_supprime::add($id_login, $motif, date('Y-m-d'), request()->session()->get('administrateur')->id);
            return back()->with('success', "Utilisateur supprimé!");
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
    public function modification_fonction_utilisateur(Request $request) {
        try {
            $id_utilisateur = $request->input('id_utilisateur');
            $id_fonction = $request->input('id_fonction');
            $login = login::getByIdUtilisateur($id_utilisateur)[0];
            login::add_raison_modification_fonction($id_utilisateur, $login->login, $login->mot_de_passe, $id_fonction, date('Y-m-d'), request()->session()->get('administrateur')->id);
            utilisateur_supprime::add($login->id, 'Changement de fonction', date('Y-m-d'), request()->session()->get('administrateur')->id);
            return back()->with('success', "Fonction de l'utilisateur modifiée!");
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
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
        try {
            personne::add($nom, $prenom, false);
            utilisateur::add(personne::getLast()[0]->id, $email, $telephone1, $telephone2, $telephone3, $id_district, $id_region, $ministere, $direction, $lieu_de_travail, $photo_de_profil, request()->session()->get('administrateur')->id, date('y-m-d'));
            $utilisateur = utilisateur::getLast()[0];
            $mdp = Str::random(10);
            login::add($utilisateur->id, $email, $mdp, $id_fonction, date('y-m-d'), request()->session()->get('administrateur')->id);
            $data = array('name'=>$nom.' '.$prenom, 'mdp'=>$mdp, 'fonction'=>fonction::getById($id_fonction)[0]->nom, 'login'=>$email);
            Mail::send('mail_inscription', $data, function($message) use($email) {
                $message->to($email, "")->subject("Inscription sur le portail de l'UCP");
                $message->from('no-reply.ucp@hotmail.com','Unité de Coordination des Projets (UCP)');
            });
            return back()->with('success',"Inscription effectuée avec succès!");
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
    public function recherche_utilisateurs(Request $request) {
        $fonction = $request->input('fonction');
        $utilisateurs = utilisateur::getAllRecherche($request->input('fonction'), $request->input('recherche'), 5);
        $fonctions = [];
        $regions = [];
        $districts = [];
        for ($i=0; $i < count($utilisateurs); $i++) {
            $login = login::getByIdUtilisateur($utilisateurs[$i]->id)[0];
            $fonctions[] = fonction::getById($login->id_fonction)[0];
            $regions[] = region::getById($utilisateurs[$i]->id_region)[0];
            $districts[] = district::getById($utilisateurs[$i]->id_district)[0];
        }
        return view('admin.liste_utilisateurs', ['utilisateurs'=>$utilisateurs, 'fonctions'=>$fonctions, "regions" => $regions, "districts" => $districts, 'allFonctions'=>fonction::getAll(), 'allRegions'=>region::getAll(), 'allDistricts'=>district::getAll(), 'allMinisteres'=>ministere::getAll()]);
    }
    public function mot_de_passe_oublie_reinitialisation(Request $request) {
        try {
            $id = $request->input('id');
            $id_utilisateur = $request->input('id_utilisateur');
            $nouveau_mdp = Str::random(10);

            $utilisateur = utilisateur::getById($id_utilisateur)[0];
            $email = $utilisateur->email;
            $login = login::getByIdUtilisateur($utilisateur->id)[0];
            login::changer_mot_de_passe($login->id, $nouveau_mdp);
            $data = array('name'=>$utilisateur->nom.' '.$utilisateur->prenom, 'mdp'=>$nouveau_mdp, 'login'=>$email);
            Mail::send('reinitialisation_mdp', $data, function($message) use($email) {
                $message->to($email, "")->subject("Réinitialisation de mot de passe sur le portail de l'UCP");
                $message->from('no-reply.ucp@hotmail.com','Unité de Coordination des Projets (UCP)');
            });

            mot_de_passe_oublie::deleteById($id);
            return back()->with('success',"Réinitialisation de mot de passe effectuée avec succès!");
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
    public function mot_de_passe_oublie_refus(Request $request) {
        try {
            $id = $request->input('id');
            mot_de_passe_oublie::deleteById($id);
            return back()->with('success',"Demande rejetée!");
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
    public function plateforme_de_discussion(Request $request) {
        $theme = theme::getAll();
        $sujet = sujet::getByIdTheme($theme[0]->id, 4);
        if ($request->input('id_theme') != null) {
            $sujet = sujet::getByIdTheme($request->input('id_theme'), 4);
        }
        if ($request->input('sujet') != null) {
            $sujet = sujet::getByIdThemeSujet($theme[0]->id, $request->input('sujet'), 4);
            if ($request->input('id_theme') != null) {
                $sujet = sujet::getByIdThemeSujet($request->input('id_theme'), $request->input('sujet'), 4);
            }
        }
        $commentaire = [];
        $utilisateur_commentaire = [];
        if ($request->input('id_sujet') != null) {
            $com = commentaire::getByIdSujet($request->input('id_sujet'));
            $commentaire = $com;
            for ($j=0; $j < count($com); $j++) { 
                $personne = personne::getById($com[$j]->id_personne)[0];
                $personne->photo_de_profil = 'default_profile_picture.jpg';
                if ($personne->est_admin) {
                    $personne->id_admin = admin::getByIdPersonne($personne->id)[0]->id;
                    $utilisateur_commentaire[] = $personne;
                } else {
                    $utilisateur_commentaire[] = utilisateur::getByIdPersonne($com[$j]->id_personne)[0];
                }
            }
        }
        $utilisateur_sujet = [];
        for ($i=0; $i < count($sujet); $i++) { 
            $personne = personne::getById($sujet[$i]->id_personne)[0];
            $personne->photo_de_profil = 'default_profile_picture.jpg';
            if ($personne->est_admin) {
                $personne->id_admin = admin::getByIdPersonne($personne->id)[0]->id;
                $utilisateur_sujet[] = $personne;
            } else {
                $utilisateur_sujet[] = utilisateur::getByIdPersonne($sujet[$i]->id_personne)[0];
            }
        }
        return view('admin.plateforme_de_discussion', ['theme'=>$theme, 'sujet'=>$sujet, 'utilisateur_sujet'=>$utilisateur_sujet, 'commentaire'=>$commentaire, 'utilisateur_commentaire'=>$utilisateur_commentaire]);
    }
    public function ajouter_theme(Request $request) {
        try {
            $theme = $request->input('theme');
            theme::add($theme, Session::get('administrateur')->id);
            return back();
        } catch (\Throwable $th) {
            
            return back()->with('errorPublicationSujet', $th->getMessage());
        }
    }
    public function publier_sujet(Request $request) {
        try {
            $id_theme = $request->input('id_theme');
            $sujet = $request->input('sujet');
            sujet::add($id_theme, $sujet, Session::get('administrateur')->id_personne);
            return back();
        } catch (\Throwable $th) {
            
            return back()->with('errorPublicationSujet', $th->getMessage());
        }
    }
    public function plateforme_de_discussion_commenter(Request $request) {
        try {
            $commentaire = $request->input('commentaire');
            $id_sujet = $request->input('id_sujet');
            $admin = Session::get('administrateur');
            $personne = personne::getById($admin->id_personne)[0];
            commentaire::insert($id_sujet, $personne->id, $commentaire);

            $options = array(
                'cluster' => 'eu',
                'useTLS' => true
            );
            $pusher = new Pusher\Pusher(
                '9bf2d9ab257d9048b8bd',
                'ccee9964d838d31e2d9a',
                '1438300',
                $options
            );
            $data['commentaire'] = $commentaire;
            $data['id_sujet'] = $id_sujet;
            $data['est_admin'] = $personne->est_admin;
            $data['nom_prenom'] = $personne->prenom.' '.$personne->nom;
            $data['photo'] = 'default_profile_picture.jpg';
            $data['date_heure'] = date("Y-m-d H:i:s");
            $pusher->trigger('my-channel', 'my-event', $data);

            return back();
        } catch (\Throwable $th) {
            return back()->with('errorCommentaire', $th->getMessage());
        }
    }
}