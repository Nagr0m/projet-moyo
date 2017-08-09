<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{	
	protected $fillable = ['content', 'answer'];

	public function question() {
		return $this->belongsTo(Question::class);
	}
}
