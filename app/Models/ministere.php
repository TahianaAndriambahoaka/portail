<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ministere extends Model
{
    use HasFactory;
    public static function getAll() {
        return DB::select("SELECT * FROM ministere");
    }
}
