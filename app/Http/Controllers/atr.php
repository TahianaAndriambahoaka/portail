<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\region;
use App\Models\district;
use App\Models\fonction;
use App\Models\utilisateur;

class atr extends Controller
{
    public function profil() {
        return view('atr.profil', ['allRegions'=>region::getAll(), 'allDistricts'=>district::getAll(), 'monProfil'=>utilisateur::getById(request()->session()->get('id_utilisateur'))[0]]);
    }
}
