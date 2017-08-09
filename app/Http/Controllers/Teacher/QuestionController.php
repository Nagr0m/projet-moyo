<?php

namespace App\Http\Controllers\Teacher;

use App\User;
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $questions = Question::select('id', 'content', 'published', 'created_at')->orderBy('created_at', 'desc')->get();

        return view('teacher.questions_index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teacher.questions_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        # Validation du formulaire
        $this->validate($request, [
            'content'     => 'required|string',
            'published'   => 'required',
            'class_level' => 'required',
            'questions.*' => 'required'
        ], [
            'required' => 'Ce champ est obligatoire'
        ]);

        # Redirection si aucune question enregistrée
        if (count($request->questions) === 0)
            return redirect('teacher/questions/create')->withErrors(['message' => 'Vous devez au moins écrire une question.']);

        # Traitement du questionnaire
        $questionnaire = Question::create($request->all());

        # Traitement des questions
        foreach ($request->questions as $qid => $question)
        {   
            $answer = 'answer_' . $qid;

            $choices[] = [
                'content' => $question,
                'answer'  => isset($request->$answer) ? 'yes' : 'no'
            ];
        }

        # Insertion des questions dans la base
        $questionnaire->choices()->createMany($choices);

        # Update des données de score
        $this->publishQuestion($questionnaire);
        
        return redirect()->route('questions.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /** 
     * Ajoute les données de score pour chaque étudiant si questionnaire publié
     *
     * @param Question $question
     * @return void
     */
    protected function publishQuestion (Question $question)
    {
        if ($question->published)
        {
            $scores = Score::where('question_id', $question->id)->get();

            if (count($scores) === 0)
            {
                $students = User::select('id')->where('level', $question->class_level)->get();

                foreach ($students as $student)
                {
                    Score::create([
                        'user_id'     => $student->id,
                        'question_id' => $question->id,
                        'done'        => false
                    ]);
                }
            }

        }
        else
        {
            # Supprime les données de score existantes
            Score::where('question_id', $question->id)->delete();
        }
    }
}
