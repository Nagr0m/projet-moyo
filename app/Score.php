<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $dates = ['created_at', 'updated_at'];

	protected $fillable = [];

	public function question() {
		return $this->belongTo(Question::class);
	}

	public function user() {
		return $this->belongTo(User::class);
	}

	public function scopePublished($query) {
		return $query->where('published', true);
	}
}
