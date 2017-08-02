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
        $posts     = \App\Post::select('id', 'title', 'published')->orderBy('published_at', 'desc')->get();
        $questions = \App\Question::select('id', 'content', 'published')->orderBy('created_at', 'desc')->get();
        $comments  = \App\Comment::count();
        $students  = \App\User::where('role', 'student')->count();

        return view('teacher.dashboard', compact('posts', 'questions', 'comments', 'students'));
    }
}
