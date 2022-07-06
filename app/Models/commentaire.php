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
        ->get();
    }
}
