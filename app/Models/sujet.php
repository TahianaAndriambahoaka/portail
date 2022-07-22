<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class sujet extends Model
{
    use HasFactory;
    public static function getByIdTheme($idTheme, $nb) {
        return DB::table('sujet')
        ->where('id_theme', '=', $idTheme)
        ->orderBy('date', 'desc')
        ->paginate($nb);
    }
    public static function getByIdThemeSujet($idTheme, $sujet, $nb) {
        return DB::table('sujet')
        ->where('id_theme', '=', $idTheme)
        ->where('sujet', 'like', '%'.$sujet.'%')
        ->orderBy('date', 'desc')
        ->paginate($nb);
    }
    public static function add($id_theme, $sujet, $id_personne) {
        try {
            DB::insert(sprintf("INSERT INTO sujet VALUES (default, %d, '%s', %d, NOW())", $id_theme, $sujet, $id_personne));
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public static function deleteById($id) {
        try {
            DB::delete(sprintf("DELETE FROM sujet WHERE id = %d", $id));
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public static function updateById($id, $sujet) {
        try {
            DB::delete(sprintf("UPDATE sujet SET sujet = '%s' WHERE id = %d", $sujet, $id));
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
