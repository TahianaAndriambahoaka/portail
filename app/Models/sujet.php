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
    public static function add($id_theme, $sujet, $id_utilisateur) {
        try {
            DB::insert(sprintf("INSERT INTO sujet VALUES (default, %d, '%s', %d, NOW())", $id_theme, $sujet, $id_utilisateur));
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
