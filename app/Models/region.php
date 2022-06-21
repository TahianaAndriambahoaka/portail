<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class region extends Model
{
    use HasFactory;
    public static function getAll() {
        return DB::select("SELECT * FROM region");
    }
    public static function getById($id) {
        return DB::select(sprintf("SELECT * FROM region WHERE id = %d", $id));
    }
}
