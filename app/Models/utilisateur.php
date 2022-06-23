<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class utilisateur extends Model
{
    use HasFactory;
    public static function add($nom, $prenom, $email, $telephone1, $telephone2, $telephone3, $id_district, $id_region, $ministere, $direction, $lieu_de_travail, $photo_de_profil, $id_admin, $date) {
        try {
            $query = "insert into utilisateur values (default, '%s', '%s', '%s', '%s', '%s', '%s', %d, %d, '%s', '%s', '%s', '%s', %d, '%s')";
            $query = sprintf($query, $nom, $prenom, $email, $telephone1, $telephone2, $telephone3, $id_district, $id_region, $ministere, $direction, $lieu_de_travail, $photo_de_profil, $id_admin, $date);
            DB::insert($query);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public static function getLast() {
        try {
            return DB::select("select * from utilisateur where id = (select max(id) from utilisateur)");
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public static function getAll($fonction, $parPage) {
        try {
            // return DB::select("select * from utilisateur where id in (select id_utilisateur from login where id not in (select id_login from utilisateur_supprime))");
            $resultats = [];
            if ($fonction == 'tous') {
                $resultats =  DB::table('utilisateur')
                                ->whereIn('id', function($query){
                                    $query->select('id_utilisateur')
                                    ->from('login')
                                    ->whereNotIn('id', function($query){
                                        $query->select('id_login')
                                        ->from('utilisateur_supprime');
                                    });
                                })
                                ->paginate($parPage);
            } else {
                $resultats =  DB::table('utilisateur')
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
                                ->select('utilisateur.*')
                                ->paginate($parPage);
            }
            return $resultats;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public static function getAllWS($fonction) {
        try {
            // return DB::select("select * from utilisateur where id in (select id_utilisateur from login where id not in (select id_login from utilisateur_supprime))");
            $resultats = [];
            if ($fonction == 'tous') {
                $resultats =  DB::table('utilisateur')
                                ->whereIn('id', function($query){
                                    $query->select('id_utilisateur')
                                    ->from('login')
                                    ->whereNotIn('id', function($query){
                                        $query->select('id_login')
                                        ->from('utilisateur_supprime');
                                    });
                                })
                                ->get();
            } else {
                $resultats =  DB::table('utilisateur')
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
                                ->select('utilisateur.*')
                                ->get();
            }
            return $resultats;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public static function getById($id) {
        return DB::select(sprintf("SELECT * FROM utilisateur WHERE id = %d", $id));
    }
}
