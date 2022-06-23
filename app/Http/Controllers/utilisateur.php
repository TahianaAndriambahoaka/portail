<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class utilisateur extends Controller
{
    public function deconnexion() {
        Session::forget('id_utilisateur');
        Session::forget('id_login');
        return view('authentification.login');
    }
}
