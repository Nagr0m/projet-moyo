<?php

namespace App\Http\Controllers\Student;

use App\Score;
use App\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\UserInject;
use App\Http\Controllers\Controller;

class QuestionController extends Controller
{
	use UserInject;

    public function __construct ()
    {
        $this->setUser();
    }

    public function index (Request $request)
    {
    	$scores = Score::with('question')->where('user_id', $request->user()->id)->get();

    	return view('student.questions_index', compact('scores'));
    }

    public function answer ($id)
    {
    	$question = Question::with('choices')->findOrFail($id);

    	// dd($question);
    	return view('student.questions_answer', compact('question'));
    }
}
