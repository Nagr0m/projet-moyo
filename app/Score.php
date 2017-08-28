<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $dates = ['created_at', 'updated_at'];

	protected $fillable = ['user_id', 'question_id', 'done', 'note'];

	public function question() {
		return $this->belongsTo(Question::class);
	}

	public function user() {
		return $this->belongsTo(User::class);
	}
}
