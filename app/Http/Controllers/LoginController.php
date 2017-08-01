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
            $this->validate($request, [
                'username' => 'required|string',
                'password' => 'required|string'
            ], [
                'required' => 'Champ obligatoire'
            ]);

            if (Auth::attempt(['username' => $request->username, 'password' => $request->password]))
            {
                # Flash message
                session()->flash('message', 'Bienvenue !');

                if (Auth::user()->role === 'teacher')
                    return redirect()->intended('/teacher/home');
                
                return redirect()->intended('/student/home');
            }
        }

        # Affichage de la page de login
        return view('login');
    }

    public function logout ()
    {
        return 'logoutpage';
    }
}
