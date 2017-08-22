<?php

namespace App;

use App\Presenters\RelativeDatePresenter;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	use RelativeDatePresenter;

	protected $dates 	= ['created_at', 'updated_at'];
	protected $fillable = ['name', 'content', 'post_id'];

	public function post() 
	{
		return $this->belongsTo(Post::class);
	}
}
