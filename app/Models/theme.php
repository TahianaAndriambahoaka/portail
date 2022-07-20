<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class theme extends Model
{
    use HasFactory;
    public static function getAll() {
        return DB::select("SELECT * FROM theme");
    }
    public static function add($theme, $id_admin) {
        try {
            DB::insert(sprintf("INSERT INTO theme VALUES (default, '%s', %d)", $theme, $id_admin));
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
