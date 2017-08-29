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

    /**
     * Display dashboard student
     * 
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	$scores = \App\Score::with('question')->where(['user_id' => $request->user()->id, 'done' => true])->whereHas('question', function($query) {
            $query->where('published', true);
        })->orderBy('created_at', 'desc')->take(5)->get();

    	return view('student.dashboard', compact('scores'));
    }
}
