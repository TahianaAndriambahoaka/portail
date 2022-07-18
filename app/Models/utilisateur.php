<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class utilisateur extends Model
{
    use HasFactory;
    public static function add($id_personne, $email, $telephone1, $telephone2, $telephone3, $id_district, $id_region, $ministere, $direction, $lieu_de_travail, $photo_de_profil, $id_admin, $date) {
        try {
            $query = "insert into utilisateur values (default, %d, '%s', '%s', '%s', '%s', %d, %d, '%s', '%s', '%s', '%s', %d, '%s')";
            $query = sprintf($query, $id_personne, $email, $telephone1, $telephone2, $telephone3, $id_district, $id_region, $ministere, $direction, $lieu_de_travail, $photo_de_profil, $id_admin, $date);
            DB::insert($query);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public static function getLast() {
        try {
            return DB::select("select u.*, p.nom, p.prenom, p.est_admin from utilisateur u join personne p on (p.id = u.id_personne) where u.id = (select max(id) from utilisateur)");
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public static function getAll($fonction, $parPage) {
        try {
            $resultats = [];
            if ($fonction == 'tous') {
                $resultats =  DB::table('utilisateur')
                                ->join('personne', 'personne.id', '=', 'utilisateur.id_personne')
                                ->whereIn('utilisateur.id', function($query){
                                    $query->select('id_utilisateur')
                                    ->from('login')
                                    ->whereNotIn('id', function($query){
                                        $query->select('id_login')
                                        ->from('utilisateur_supprime');
                                    });
                                })
                                ->select(['utilisateur.*', 'personne.nom', 'personne.prenom', 'personne.est_admin'])
                                ->paginate($parPage);
            } else {
                $resultats =  DB::table('utilisateur')
                                ->join('personne', 'personne.id', '=', 'utilisateur.id_personne')
                                ->join('login', 'utilisateur.id', '=', 'login.id_utilisateur')
                                ->whereNotIn('login.id', function($query){
                                    $query->select('id_login')
                                    ->from('utilisateur_supprime');
                                })
                                ->where('login.id_fonction', '=', $fonction)
                                ->whereIn('utilisateur.id', function($query){
                                    $query->select('id_utilisateur')
                                    ->from('login')
                                    ->whereNotIn('id', function($query){
                                        $query->select('id_login')
                                        ->from('utilisateur_supprime');
                                    });
                                })
                                ->select(['utilisateur.*', 'personne.nom', 'personne.prenom', 'personne.est_admin'])
                                ->paginate($parPage);
            }
            return $resultats;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public static function getAllRecherche($fonction, $recherche, $parPage) {
        try {
            // return DB::select("select * from utilisateur where id in (select id_utilisateur from login where id not in (select id_login from utilisateur_supprime))");
            $resultats = [];
            if ($fonction == 'tous') {
                $resultats =  DB::table('utilisateur')
                                ->join('personne', 'personne.id', '=', 'utilisateur.id_personne')
                                ->join('login', 'utilisateur.id', '=', 'login.id_utilisateur')
                                ->whereNotIn('login.id', function($query){
                                    $query->select('id_login')
                                    ->from('utilisateur_supprime');
                                })
                                ->having('personne.nom', 'like', '%'.$recherche.'%')
                                ->orHaving('personne.prenom', 'like', '%'.$recherche.'%')
                                ->select(['utilisateur.*', 'personne.nom', 'personne.prenom', 'personne.est_admin'])
                                ->paginate($parPage);
            } else {
                $resultats =  DB::table('utilisateur')
                                ->join('personne', 'personne.id', '=', 'utilisateur.id_personne')
                                ->join('login', 'utilisateur.id', '=', 'login.id_utilisateur')
                                ->join('fonction', 'fonction.id', '=', 'login.id_fonction')
                                ->whereNotIn('login.id', function($query){
                                    $query->select('id_login')
                                    ->from('utilisateur_supprime');
                                })
                                ->havingRaw("id_fonction = ".$fonction." and (personne.prenom like '%".$recherche."%' or personne.nom like '%".$fonction."%')")
                                ->select(['utilisateur.*', 'personne.nom', 'personne.prenom', 'personne.est_admin', 'login.id_fonction'])
                                ->paginate($parPage);
            }
            return $resultats;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public static function getPersonne($id) {
        return DB::select(sprintf("SELECT p.* FROM utilisateur u join personne p on (p.id = u.id_personne) WHERE u.id = %d", $id));
    }
    public static function getById($id) {
        return DB::select(sprintf("SELECT u.*, p.nom, p.prenom, p.est_admin FROM utilisateur u join personne p on (p.id = u.id_personne) WHERE u.id = %d", $id));
    }
    public static function getByIdPersonne($id_personne) {
        return DB::select(sprintf("SELECT u.*, p.nom, p.prenom, p.est_admin FROM utilisateur u join personne p on (p.id = u.id_personne) WHERE p.id = %d", $id_personne));
    }
    public static function getByNomPrenomEmail($nom, $prenom, $email) {
        return DB::select(sprintf("SELECT u.*, p.nom, p.prenom, p.est_admin FROM utilisateur u join personne p on (p.id = u.id_personne) WHERE p.nom = '%s' AND p.prenom = '%s' AND u.email = '%s'", $nom, $prenom, $email));
    }
    public static function update_photo_de_profil($login, $photo_de_profil) {
        try {
            $query = "UPDATE utilisateur SET photo_de_profil = '%s' WHERE id = %d";
            $query = sprintf($query, $photo_de_profil, $login->id_utilisateur);
            DB::update($query);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public static function update_profil($id_personne, $login, $nom, $prenom, $telephone1, $telephone2, $telephone3, $email) {
        try {
            $query = "UPDATE utilisateur SET  telephone1 = '%s', telephone2 = '%s', telephone3 = '%s', email = '%s' WHERE id = %d";
            $query = sprintf($query, $telephone1, $telephone2, $telephone3, $email, $login->id_utilisateur);
            DB::update($query);

            $query = "UPDATE personne SET nom = '%s', prenom = '%s' WHERE id = %d";
            $query = sprintf($query, $nom, $prenom, $id_personne);
            DB::update($query);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
