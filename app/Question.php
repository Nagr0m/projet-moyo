<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
	protected $dates = ['created_at', 'updated_at'];

	protected $fillable = [];

	public function choices() {
		return $this->asMany(Choice::class);
	}

	public function scores() {
		return $this->asMany(Score::class);
	}
}
