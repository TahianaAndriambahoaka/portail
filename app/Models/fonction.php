<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class fonction extends Model
{
    use HasFactory;
    public static function getAll() {
        return DB::select("SELECT * FROM fonction");
    }
    public static function getById($id) {
        return DB::select(sprintf("SELECT * FROM fonction WHERE id = %d", $id));
    }
}
