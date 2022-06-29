<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class utilisateur_supprime extends Model
{
    use HasFactory;
    public static function add($id_login, $motif, $date, $id_admin) {
        try {
            $query = "insert into utilisateur_supprime values (default, %d, '%s', '%s', %d)";
            $query = sprintf($query, $id_login, $motif, $date, $id_admin);
            DB::insert($query);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
