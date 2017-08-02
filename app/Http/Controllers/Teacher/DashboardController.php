<?php

namespace App\Http\Controllers\Teacher;

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

    public function index ()
    {   
        $posts     = \App\Post::orderBy('published_at', 'desc')->get();
        $questions = \App\Question::all();
        $comments  = \App\Comment::all();
        $students  = \App\User::where('role', 'student')->count();

        return view('teacher.dashboard', compact('posts', 'questions', 'comments', 'students'));
    }
}
