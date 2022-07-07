<?php

namespace App\Http\Controllers;

use App\Models\commentaire;
use App\Models\login;
use App\Models\sujet;
use App\Models\theme;
use App\Models\utilisateur as ModelsUtilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mail;
use Image;

class utilisateur extends Controller
{
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
                $utilisateur_commentaire[] = ModelsUtilisateur::getById($com[$j]->id_utilisateur)[0];
            }
        }
        $utilisateur_sujet = [];
        for ($i=0; $i < count($sujet); $i++) { 
            $utilisateur_sujet[] = ModelsUtilisateur::getById($sujet[$i]->id_utilisateur)[0];
        }
        return view('atr.plateforme_de_discussion', ['theme'=>$theme, 'sujet'=>$sujet, 'utilisateur_sujet'=>$utilisateur_sujet, 'commentaire'=>$commentaire, 'utilisateur_commentaire'=>$utilisateur_commentaire]);
    }
    public function deconnexion() {
        Session::forget('login');
        return view('authentification.login');
    }
    public function changer_mot_de_passe(Request $request) {
        try {
            $ancienMDP = $request->input('ancienMdp');
            $nouveauMdp1 = $request->input('nouveauMdp1');
            $nouveauMdp2 = $request->input('nouveauMdp2');
            if ($ancienMDP == $nouveauMdp1 or $ancienMDP == $nouveauMdp2 or $nouveauMdp1 != $nouveauMdp2) {
                return back()->with('errorMDP', "Une erreur s'est produite");
            } else {
                $login = request()->session()->get('login');
                $utilisateur = \App\Models\utilisateur::getById($login->id_utilisateur)[0];
                $email = $login->login;
                login::changer_mot_de_passe($login->id, $nouveauMdp1);
                $data = array('name'=>$utilisateur->nom.' '.$utilisateur->prenom);
                Mail::send('mail_changer_mdp', $data, function($message) use($email) {
                    $message->to($email, "")->subject("Changement de mot de passe sur le portail de l'UCP");
                    $message->from('no-reply.ucp@hotmail.com','Unité de Coordination des Projets (UCP)');
                });
                $login = login::getByIdUtilisateur($utilisateur->id)[0];
                Session::forget('login');
                Session::put('login', $login);
                return back()->with('successMDP', "Changement de mot de passe effectué avec succès!");
            }
        } catch (\Throwable $th) {
            return back()->with('errorMDP', $th->getMessage());
        }
    }
    public function changer_photo_de_profil(Request $request) {
        if ($request->hasFile('profile_photo')) {
            try {
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
                \App\Models\utilisateur::update_photo_de_profil(request()->session()->get('login'), $photo_de_profil);
                return back()->with('successPDP', "Changement de photo de profil effectué avec succès!");
            } catch (\Throwable $th) {
                return back()->with('errorPDP', $th->getMessage());
            }
        } else {
            return back();
        }
    }
    public function modification_de_profil(Request $request) {
        try {
            $mot_de_passe = $request->input('mot_de_passe');
            $nom = $request->input('nom');
            $prenom = $request->input('prenom');
            $telephone1 = $request->input('telephone1');
            $telephone2 = $request->input('telephone2');
            $telephone3 = $request->input('telephone3');
            $email = $request->input('email');
            $login = request()->session()->get('login');
            \App\Models\utilisateur::update_profil($login, $nom, $prenom, $telephone1, $telephone2, $telephone3, $email);
            if ($email != $login->login) {
                login::changer_login($login->id, $email);
                $l = login::getByIdUtilisateur($login->id_utilisateur)[0];
                $utilisateur = \App\Models\utilisateur::getById($l->id_utilisateur)[0];
                Session::forget('login');
                Session::put('login', $l);
                $data = array('name'=>$utilisateur->nom.' '.$utilisateur->prenom, 'mdp'=>$mot_de_passe, 'login'=>$l->login);
                Mail::send('mail_changer_login', $data, function($message) use($email) {
                    $message->to($email, "")->subject("Changement de mail et de login sur le portail de l'UCP");
                    $message->from('no-reply.ucp@hotmail.com','Unité de Coordination des Projets (UCP)');
                });
            }
            return back()->with('successProfil', "Modification de profil effectuée avec succès!");
        } catch (\Throwable $th) {
            return back()->with('errorProfil', $th->getMessage());
        }
    }
    public function plateforme_de_discussion_commenter(Request $request) {
        try {
            $commentaire = $request->input('commentaire');
            $id_sujet = $request->input('id_sujet');
            commentaire::insert($id_sujet, Session::get('login')->id_utilisateur, $commentaire);
            return back();
        } catch (\Throwable $th) {
            return back()->with('errorCommentaire', $th->getMessage());
        }
    }
    public function publier_sujet(Request $request) {
        try {
            $id_theme = $request->input('id_theme');
            $id_utilisateur = Session::get('login')->id_utilisateur;
            $sujet = $request->input('sujet');
            sujet::add($id_theme, $sujet, $id_utilisateur);
            return back();
        } catch (\Throwable $th) {
            
            return back()->with('errorPublicationSujet', $th->getMessage());
        }
    }
}
