<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Presenters\CommentsIconPresenter;
use App\Presenters\RelativeDatePresenter;

class Comment extends Model
{
	use RelativeDatePresenter;
	use CommentsIconPresenter;

	protected $dates 	= ['created_at', 'updated_at'];
	protected $fillable = ['name', 'content', 'post_id'];

	public function post() 
	{
		return $this->belongsTo(Post::class);
	}
}
