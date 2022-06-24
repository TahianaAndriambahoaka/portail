<?php

namespace App\Http\Controllers;

use App\Models\login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mail;

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
                return back()->with('successMDP', "Changement de mot de passe effectué avec succès!");
            }
        } catch (\Throwable $th) {
            return back()->with('errorMDP', $th->getMessage());
        }
    }
}
