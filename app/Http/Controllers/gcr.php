<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\region;
use App\Models\district;
use App\Models\utilisateur;

class gcr extends Controller
{
    public function profil() {
        return view('gcr.profil', ['allRegions'=>region::getAll(), 'allDistricts'=>district::getAll(), 'monProfil'=>utilisateur::getById(request()->session()->get('login')->id_utilisateur)[0]]);
    }
}
