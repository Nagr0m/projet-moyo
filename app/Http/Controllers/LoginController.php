<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login (Request $request)
    {   
        # Traitement du login
        if ($request->isMethod('post'))
        {

        }

        # Affichage de la page de login
        return view('login');
    }

    public function logout ()
    {
        return 'logoutpage';
    }
}
