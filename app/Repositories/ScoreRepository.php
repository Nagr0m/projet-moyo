<?php

namespace App\Repositories;

use Auth;
use App\Score;

class ScoreRepository
{
    protected $score;

    public function __construct (Score $score)
    {
        $this->score = $score;
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


}