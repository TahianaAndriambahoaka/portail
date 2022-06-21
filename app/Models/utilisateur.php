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
    public static function getAll() {
        try {
            return DB::select("select * from utilisateur");
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
