<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class commentaire extends Model
{
    use HasFactory;
    public static function getByIdSujet($idSujet) {
        return DB::table('commentaire')
        ->where('id_sujet', '=', $idSujet)
        ->orderBy('date', 'asc')
        ->get();
    }
    public static function insert($id_sujet, $id_personne, $commentaire) {
        try {
            $query = sprintf("INSERT INTO commentaire VALUES (default, %d, %d, '%s', NOW())", $id_sujet, $id_personne, $commentaire);
            DB::insert($query);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
