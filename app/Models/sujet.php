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
        ->paginate($nb);
    }
    public static function getByIdThemeSujet($idTheme, $sujet, $nb) {
        return DB::table('sujet')
        ->where('id_theme', '=', $idTheme)
        // ->where('sujet', '=', $sujet)
        ->where('sujet', 'like', '%'.$sujet.'%')
        ->paginate($nb);
    }
}
