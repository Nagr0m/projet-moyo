<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\UserInject;
use App\Http\Controllers\Controller;
use App\Repositories\ScoreRepository;

class DashboardController extends Controller
{
    use UserInject;

    public function __construct ()
    {
        $this->setUser();
    }

    /**
     * Dashboard home
     *
     * @return \Illuminate\Http\Response
     */
    public function index ()
    {   
        $posts     = \App\Post::select('id', 'title', 'published')->orderBy('created_at', 'desc')->get();
        $questions = \App\Question::select('id', 'title', 'published')->orderBy('created_at', 'desc')->get();
        $comments  = \App\Comment::count();
        $students  = \App\User::where('role', 'student')->count();

        return view('teacher.dashboard', compact('posts', 'questions', 'comments', 'students'));
    }

    public function studentsPage (ScoreRepository $ScoreRepository)
    {   
        $students = \App\User::where('role', 'student')->with('scores')->get()->groupBy('level');
        $totalChoices = [
            'first_class' => $ScoreRepository->totalChoices('first_class'),
            'final_class' => $ScoreRepository->totalChoices('final_class')
        ];

        return view('teacher.students', compact('students', 'ScoreRepository', 'totalChoices'));
    }
}
