<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class mot_de_passe_oublie extends Model
{
    use HasFactory;
    public static function add($nom, $prenom, $email, $date) {
        try {
            $query = "insert into mot_de_passe_oublie values (default, '%s', '%s', '%s', '%s')";
            $query = sprintf($query, $nom, $prenom, $email, $date);
            DB::insert($query);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public static function getAll($parPage) {
        return DB::table('mot_de_passe_oublie')
        ->orderBy('date', 'desc')
        ->paginate($parPage);
    }
    public static function deleteById($id) {
        try {
            DB::delete(sprintf("DELETE FROM mot_de_passe_oublie WHERE id = %d", $id));
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
