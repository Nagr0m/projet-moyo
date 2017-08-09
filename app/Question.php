<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
	protected $dates = ['created_at', 'updated_at'];

	protected $fillable = ['content', 'class_level', 'published'];

	public function choices() {
		return $this->hasMany(Choice::class);
	}

	public function scores() {
		return $this->hasMany(Score::class);
	}

	public function scopePublished($query) {
		return $query->where('published', true);
	}
}
