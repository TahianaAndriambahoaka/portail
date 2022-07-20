<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class admin extends Model
{
    use HasFactory;
    public static function getPersonne($id) {
        return DB::select(sprintf("SELECT p.* FROM admin a join personne p on (p.id = a.id_personne) WHERE a.id = %d", $id));
    }
    public static function getByIdPersonne($id_personne) {
        return DB::select(sprintf("SELECT * FROM admin WHERE id_personne = %d", $id_personne));
    }
}
