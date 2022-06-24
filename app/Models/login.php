<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class login extends Model
{
    use HasFactory;
    public static function connexion($login, $mot_de_passe) {
        $sql1 = "SELECT * FROM admin WHERE login = '%s' and mot_de_passe = sha2('%s', 256)";
        $sql1 = sprintf($sql1, $login, $mot_de_passe);
        $sql1 = DB::select($sql1);

        $sql2 = "SELECT * FROM login WHERE login = '%s' and mot_de_passe = sha2('%s', 256) AND id NOT IN (select id_login from utilisateur_supprime)";
        $sql2 = sprintf($sql2, $login, $mot_de_passe);

        if (count($sql1) > 0) {
            $sql1[] = 'admin';
            return $sql1;
        } else {
            $sql2 = DB::select($sql2);
            if (count($sql2) > 0) {
                $sql2[] = 'utilisateur';
                return $sql2;
            } else {
                return [];
            }
        }
    }
    public static function add($id_utilisateur, $login, $mot_de_passe, $id_fonction, $date_debut_de_carriere) {
        try {
            $query = "insert into login values (default, %d, '%s', sha2('%s', 256), %d, '%s')";
            $query = sprintf($query, $id_utilisateur, $login, $mot_de_passe, $id_fonction, $date_debut_de_carriere);
            DB::insert($query);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public static function getByIdUtilisateur($id_utilisateur) {
        return DB::select(sprintf("SELECT * FROM login WHERE id_utilisateur = %d AND id NOT IN (SELECT id_login FROM utilisateur_supprime)", $id_utilisateur));
    }
    public static function changer_mot_de_passe($id, $ancienMDP, $nouveauMDP) {
        try {
            $query = "update login set mot_de_passe = sha2('%s', 256) where id = %d and mot_de_passe = sha2('%s', 256)";
            $query = sprintf($query, $nouveauMDP, $id, $ancienMDP);
            DB::update($query);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
