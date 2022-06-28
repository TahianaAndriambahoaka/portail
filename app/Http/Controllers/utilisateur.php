<?php

namespace App\Http\Controllers;

use App\Models\login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mail;
use Image;

class utilisateur extends Controller
{
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
                login::changer_mot_de_passe($login->id, $ancienMDP, $nouveauMdp1);
                $data = array('name'=>$utilisateur->nom.' '.$utilisateur->prenom, 'mdp'=>$nouveauMdp1, 'login'=>$email);
                Mail::send('mail_changer_mdp', $data, function($message) use($email) {
                    $message->to($email, "")->subject("Changement de mot de passe sur le portail de l'UCP");
                    $message->from('tahiana.andriamb@gmail.com','Unité de Coordination des Projets (UCP)');
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
                    $message->from('tahiana.andriamb@gmail.com','Unité de Coordination des Projets (UCP)');
                });
            }
            return back()->with('successProfil', "Modification de profil effectuée avec succès!");
        } catch (\Throwable $th) {
            return back()->with('errorProfil', $th->getMessage());
        }
    }
}
