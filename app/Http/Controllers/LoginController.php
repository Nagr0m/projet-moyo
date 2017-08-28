<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{   
    /**
     * Login page and form handling
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
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
                    return redirect()->route('teacher/home');
                
                return redirect()->route('student/home');
            }

            session()->flash('message', 'Identifiants incorrects !');
        }

        # Redirection automatique si déjà loggué
        if (Auth::check())
        {
            if (Auth::user()->role === 'teacher')
                return redirect()->route('teacher/home');
            
            return redirect()->route('student/home');
        }

        # Affichage de la page de login
        return view('login');
    }

    /**
     * Logout
     *
     * @return \Illuminate\Http\Response
     */
    public function logout ()
    {
        if(Auth::check())
    	{
    		Auth::logout();
    		session()->flash('message', 'À bientôt !');
    	}

    	return redirect()->intended('/');
    }
}
