<?php

namespace App\Http\Controllers\Student;

use App\Score;
use App\Choice;
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
    	$scores = Score::with('question')->where('user_id', $request->user()->id)->whereHas('question', function($query) {
            $query->where('published', true);
        })->get();

    	return view('student.questions_index', compact('scores'));
    }

    public function answer (Request $request, $id)
    {
        $score = Score::where(['user_id' => $request->user()->id, 'question_id' => $id])->firstOrFail();
        if ($score->done)
            return redirect()->route('student/questions')->with('message', 'Vous avez déjà fait ce questionnaire');

    	$question = Question::with('choices')->findOrFail($id);

    	// dd($question);
    	return view('student.questions_answer', compact('question'));
    }


    public function submit (Request $request, $id)
    {
        $choices = Choice::where('question_id', $id)->get()->keyBy('id');
        $score = Score::where(['user_id' => $request->user()->id, 'question_id' => $id])->firstOrFail();
        $note = 0;

        foreach ($choices as $key => $choice) {
            if ($choice->answer == $request->input($key)) $note++;
        }
        
        $score->update(['note' => $note, 'done' => true]);
        return redirect()->route('student/questions')->with('message', 'Merci d\'avoir completé le questionnaire');
    }
}
