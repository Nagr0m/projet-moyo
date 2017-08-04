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

    public function index()
    {
    	$user = \Auth::user();
    	$scores = \App\Score::where('user_id', $user->id)->get();
    	$questions = \App\Question::with('scores')->where('class_level', $user->level)->published();
    	$questionsAll = $questions->get();
    	$questionsDone = $questions->whereHas('scores', function ($query) { $query->where('user_id', \Auth::user()->id); })->get();
    	$questionsToDo = $questions->whereDoesntHave('scores', function ($query) { $query->where('user_id', \Auth::user()->id); })->get();

    	dd($questionsAll, $questionsDone, $questionsToDo);

    	return view('student.dashboard', compact('questionsAll', 'questionsDone', 'scores'));
    }
}
