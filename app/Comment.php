<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	protected $dates = ['created_at', 'updated_at'];

	protected $fillable = [];

	public function post() {
		return $this->belongsTo(Post::class);
	}
}
