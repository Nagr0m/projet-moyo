<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{   
    /**
     * Login
     *
     * @param \App\Http\Requests\LoginRequest $request
     * @return \Illuminate\Http\Response
     */
    public function login (LoginRequest $request)
    {   
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password]))
        {
            # Flash message
            session()->flash('message', 'Bienvenue !');

            if (Auth::user()->role === 'teacher')
                return redirect()->route('teacher/home');
            
            return redirect()->route('student/home');
        }
        session()->flash('message', 'Identifiants incorrects !');
        
        return redirect()->back()->withInput();
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
