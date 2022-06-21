<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class district extends Model
{
    use HasFactory;
    public static function getAll() {
        return DB::select("SELECT * FROM district");
    }
    public static function getById($id) {
        return DB::select(sprintf("SELECT * FROM district WHERE id = %d", $id));
    }
}
