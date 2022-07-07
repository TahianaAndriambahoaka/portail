<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Mail;

class demande_inscription extends Model
{
    use HasFactory;
    public static function add($nom, $prenom, $email, $telephone1, $telephone2, $telephone3, $id_district, $id_region, $ministere, $direction, $lieu_de_travail, $photo_de_profil, $id_fonction, $date) {
        try {
            $query = "insert into demande_inscription values (default, '%s', '%s', '%s', '%s', '%s', '%s', %d, %d, '%s', '%s', '%s', '%s', %d, '%s')";
            $query = sprintf($query, $nom, $prenom, $email, $telephone1, $telephone2, $telephone3, $id_district, $id_region, $ministere, $direction, $lieu_de_travail, $photo_de_profil, $id_fonction, $date);
            DB::insert($query);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public static function getAll($parPage) {
        return  DB::table('demande_inscription')
        ->orderBy('date', 'desc')
        ->paginate($parPage);
        // return DB::select("SELECT * FROM demande_inscription");
    }
    public static function getById($id) {
        return DB::select(sprintf("SELECT * FROM demande_inscription WHERE id = %d", $id));
    }
    public static function deleteById($id) {
        try {
            DB::delete(sprintf("DELETE FROM demande_inscription WHERE id = %d", $id));
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public static function valider($id) {
        try {
            $demande = demande_inscription::getById($id)[0];
            utilisateur::add($demande->nom, $demande->prenom, $demande->email, $demande->telephone1, $demande->telephone2, $demande->telephone3, $demande->id_district, $demande->id_region, $demande->ministere, $demande->direction, $demande->lieu_de_travail, $demande->photo_de_profil, request()->session()->get('administrateur')->id, $demande->date);
            $utilisateur = utilisateur::getLast()[0];
            $mdp = Str::random(10);
            login::add($utilisateur->id, $demande->email, $mdp, $demande->id_fonction, date('y-m-d'));
            demande_inscription::deleteById($id);
            $email = $demande->email;
            $data = array('name'=>$demande->nom.' '.$demande->prenom, 'mdp'=>$mdp, 'fonction'=>fonction::getById($demande->id_fonction)[0]->nom, 'login'=>$email);
            Mail::send('mail', $data, function($message) use($email) {
                $message->to($email, "")->subject("Validation de demande d'inscription");
                $message->from('tahiana.andriamb@gmail.com','Unité de Coordination des Projets (UCP)');
            });
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public static function refuser($id) {
        try {
            $demande = demande_inscription::getById($id)[0];
            $imagePath = public_path('images/photo_de_profil/'.$demande->photo_de_profil);
            if ($demande->photo_de_profil != 'default_profile_picture.jpg') {
                unlink($imagePath);
            }
            demande_inscription::deleteById($id);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
