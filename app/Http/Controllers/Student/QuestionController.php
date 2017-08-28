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

    /**
     * Display a listing of the resource.
     * 
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function index (Request $request)
    {
    	$scores = Score::with('question')->where('user_id', $request->user()->id)->whereHas('question', function($query) {
            $query->where('published', true);
        })->get();

        session(['note' => 1, 'choicesCount' => 5]);

    	return view('student.questions_index', compact('scores'));
    }

    /**
     * Display the question form
     * 
     * @param  Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function answer (Request $request, $id)
    {
        $score = Score::where(['user_id' => $request->user()->id, 'question_id' => $id])->firstOrFail();
        if ($score->done)
            return redirect()->route('student/questions')->with('message', 'Vous avez déjà fait ce questionnaire');

    	$question = Question::with('choices')->findOrFail($id);

    	// dd($question);
    	return view('student.questions_answer', compact('question'));
    }

    /**
     * Check response and calculate score
     *  
     * @param  Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function submit (Request $request, $id)
    {
        $choices = Choice::where('question_id', $id)->get()->keyBy('id');
        $score = Score::where(['user_id' => $request->user()->id, 'question_id' => $id])->firstOrFail();
        $note = 0;

        foreach ($choices as $key => $choice) {
            if ($choice->answer == $request->input($key)) $note++;
        }
        
        $score->update(['note' => $note, 'done' => true]);
        return redirect()->route('student/questions')->with(['note' => $note, 'choicesCount' => $choices->count()]);
    }
}
