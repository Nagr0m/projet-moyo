<?php

namespace App\Http\Controllers\Student;

use App\Choice;
use App\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\UserInject;
use App\Http\Controllers\Controller;
use App\Repositories\ScoreRepository;

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
    public function index (ScoreRepository $ScoreRepository, Request $request)
    {
    	$scores = $ScoreRepository->getUserScoresPaginate(3);

    	return view('student.questions_index', compact('scores'));
    }

    /**
     * Display the question form
     * 
     * @param  Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function answer (ScoreRepository $ScoreRepository, Request $request, $id)
    {   
        if ($ScoreRepository->isDone($id))
            return redirect()->route('student/questions')->with('message', 'Vous avez déjà fait ce questionnaire');

    	$question = Question::with('choices')->findOrFail($id);

    	return view('student.questions_answer', compact('question'));
    }

    /**
     * Check response and calculate score
     *  
     * @param  Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function submit (ScoreRepository $ScoreRepository,Request $request, $id)
    {
        $choices = Choice::where('question_id', $id)->get()->keyBy('id');
        $score   = $ScoreRepository->getScoreByQuestion($id);
        $note    = 0;

        foreach ($choices as $key => $choice) {
            if ($choice->answer == $request->input($key)) $note++;
        }
        
        $score->update(['note' => $note, 'done' => true]);
        return redirect()->route('student/questions')->with(['note' => $note, 'choicesCount' => $choices->count()]);
    }
}
