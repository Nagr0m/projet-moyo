<?php

namespace App\Repositories;

use Auth;
use App\Score;
use App\Choice;

class ScoreRepository
{
    protected $score;
    protected $choice;

    public function __construct (Score $score, Choice $choice)
    {
        $this->score = $score;
        $this->choice = $choice;
    }

    /**
     * Retrieves all user's scores with questionaries
     *
     * @param int $int
     * @return \Illuminate\Support\Collection
     */
    public function getUserScoresPaginate (int $int)
    {
        return $this->score
                    ->with('question')
                    ->where('user_id', Auth::user()->id)
                    ->whereHas('question', function ($query) { $query->where('published', true); })
                    ->orderBy('created_at', 'desc')
                    ->paginate($int);
    }

    /**
     * Retrieves some user's scores with questionaries
     * 
     * @param  int    $int 
     * @return \Illuminate\Support\Collection
     */
    public function getUserScoresToDo (int $int)
    {
        return $this->score
                    ->with('question')
                    ->where('user_id', Auth::user()->id)
                    ->whereHas('question', function ($query) { $query->where('published', true); })
                    ->orderBy('created_at', 'desc')
                    ->take($int)
                    ->get();
    }

    /**
     * Check if the questionary has already been done by the user
     *
     * @param int $question_id
     * @return bool
     */
    public function isDone (int $question_id)
    {   
        return (bool) $this->getScoreByQuestion($question_id)
                           ->done;
    }

    /**
     * Retrieve the user's score from a questionary ID
     *
     * @param int $question_id
     * @return \Illuminate\Support\Collection
     */
    public function getScoreByQuestion (int $question_id)
    {
        return $this->score
                    ->where(['user_id' => Auth::user()->id, 'question_id' => $question_id])
                    ->firstOrFail();
    }

    /**
     * Retrive the user's total score
     *
     * @param $userID
     * @return int
     */
    public function totalScore ($userID = null)
    {   
        if (is_null($userID)) $userID = Auth::user()->id;

        return (int) $this->score
                          ->where('user_id', $userID)
                          ->sum('note');
    }

    /**
     * Retrieve the user's total answered choices
     * 
     * @param $userID
     * @return int
     */
    public function totalAnsweredChoices ($userID = null)
    {   
        if (is_null($userID)) $userID = Auth::user()->id;

        return (int) $this->choice
                          ->whereHas('question.scores', function ($query) use ($userID) { $query->where(['user_id' => $userID, 'done' => true]); })
                          ->count();
    }


}