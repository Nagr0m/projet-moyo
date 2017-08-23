<?php

namespace App;

use App\Presenters\CommonDatePresenter;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
	use CommonDatePresenter;

	protected $dates 	= ['created_at', 'updated_at'];
	protected $fillable = ['title', 'content', 'class_level', 'published'];

	public function choices() 
	{
		return $this->hasMany(Choice::class);
	}

	public function scores() 
	{
		return $this->hasMany(Score::class);
	}

	public function scopePublished($query) 
	{
		return $query->where('published', true);
	}

	public function getChoicesCountAttribute() {
		return $this->choices->count();
	}
}
