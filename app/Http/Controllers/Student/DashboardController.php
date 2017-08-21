<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\UserInject;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
	use UserInject;

    public function __construct ()
    {
        $this->setUser();
    }

    public function index(Request $request)
    {
    	$scores = \App\Score::with('question')->where('user_id', $request->user()->id)->get();

    	// dd($request->user());

    	return view('student.dashboard', compact('scores'));
    }
}
