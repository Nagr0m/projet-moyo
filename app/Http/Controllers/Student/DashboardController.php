<?php

namespace App\Http\Controllers\Student;

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
     * Display dashboard student
     * 
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(ScoreRepository $ScoreRepository, Request $request)
    {
    	$scores = $ScoreRepository->getUserScoresToDo(5);
        $totalScore = $ScoreRepository->totalScore();
        $totalAnsweredChoices = $ScoreRepository->totalAnsweredChoices();


    	return view('student.dashboard', compact('scores', 'totalScore', 'totalAnsweredChoices'));
    }
}
