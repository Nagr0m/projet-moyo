<?php

namespace App\Http\Controllers\Teacher;

use App\Score;
use App\Choice;
use App\Question;
use App\Http\Controllers\UserInject;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassUpdateRequest;
use App\Http\Requests\QuestionaryRequest;

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
        $questions = Question::withCount(['scores', 'scores as done' => function ($query) {
                            $query->where('done', true);
                        }])->orderBy('created_at', 'desc')->paginate(5);

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
     * @param  \App\Http\Requests\QuestionaryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionaryRequest $request)
    {   
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

        # Création des données de score
        $this->publishQuestion($questionnaire);
        
        return redirect()->route('questions.index')->with('message', 'Le questionnaire a bien été créé');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        return view('teacher.questions_edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\QuestionaryRequest  $request
     * @param  \App\Question $question
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionaryRequest $request, Question $question)
    {
        # Traitement du questionnaire@if (count($posts) > 0)
        $question->update($request->all());

        # Traitement des questions
        foreach ($question->choices as $choice)
        {   
            $choice->update([
                'content' => $request->question[$choice->id],
                'answer'  => isset($request->answer[$choice->id]) ? 'yes' : 'no'
            ]);
        }
        
        return redirect()->route('questions.index')->with('message', 'Le questionnaire a été mis à jour');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Question::find($id)->delete();

        return redirect()->route('questions.index')->with('message', 'Le questionnaire a été supprimé');
    }

    /**
     * Mass questions updating
     *
     * @param \App\Http\Requests\MassUpdateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function multiplePatch (MassUpdateRequest $request)
    {
        if ($request->operation === 'delete')
        {
            Question::destroy($request->items);
            $message = 'Les questionnaires ont été supprimés';
        }
        else 
        {
            Question::whereIn('id', $request->items)->update(['published' => ($request->operation === 'publish')]);
            $message = 'Le statut des questionnaires a été mis à jour';
        }

        return redirect()->route('questions.index')->with('message', $message);
    }

    /** 
     * Ajoute les données de score pour chaque étudiant
     *
     * @param \App\Question $question
     * @return void
     */
    public function publishQuestion (Question $question)
    {   
        $students = User::select('id')->where('level', $question->class_level)->get();

        if (count($students) > 0) 
        {
            foreach ($students as $student)
            {   
                # Insère les données de score pour chaque étudiant
                Score::create([
                    'user_id'     => $student->id,
                    'question_id' => $question->id,
                    'done'        => false
                ]);
            }
        }
    }
}
