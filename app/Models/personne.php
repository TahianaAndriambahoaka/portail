<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class personne extends Model
{
    use HasFactory;
    public static function add($nom, $prenom, $est_admin) {
        try {
            $query = "insert into personne values (default, '%s', '%s', false)";
            if ($est_admin == true) {
                $query = "insert into personne values (default, '%s', '%s', true)";
            }
            $query = sprintf($query, $nom, $prenom, $est_admin);
            DB::insert($query);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public static function getLast() {
        try {
            return DB::select("select * from personne where id = (select max(id) from personne)");
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
