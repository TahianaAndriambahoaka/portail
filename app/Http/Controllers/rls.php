<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\region;
use App\Models\district;
use App\Models\utilisateur;

class rls extends Controller
{
    public function profil() {
        return view('rls.profil', ['allRegions'=>region::getAll(), 'allDistricts'=>district::getAll(), 'monProfil'=>utilisateur::getById(request()->session()->get('login')->id_utilisateur)[0]]);
    }
}
