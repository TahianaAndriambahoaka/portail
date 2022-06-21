<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class utilisateur_supprime extends Model
{
    use HasFactory;
    public static function add($id_login, $motif, $date) {
        try {
            $query = "insert into utilisateur_supprime values (default, %d, '%s', '%s')";
            $query = sprintf($query, $id_login, $motif, $date);
            DB::insert($query);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
