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


    public function getUserScoresToDo (int $int)
    {
        return $this->score
                    ->with('question')
                    ->where(['user_id' => Auth::user()->id, 'done' => false])
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


    public function totalScore ($userID = null)
    {   
        if (is_null($userID)) $userID = Auth::user()->id;

        return (int) $this->score
                          ->where('user_id', $userID)
                          ->sum('note');
    }

    public function totalChoices ($userLevel = null)
    {   
        if (is_null($userLevel)) $userLevel = Auth::user()->level;

        return (int) $this->choice
                          ->whereHas('question', function ($query) use ($userLevel) { $query->where('class_level', $userLevel); })
                          ->count();
    }


}