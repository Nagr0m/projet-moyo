<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $dates = ['created_at', 'updated_at', 'published_at'];

    protected $fillable = [];

	public function user() {
		return $this->belongsTo(User::class);
	}

	public function comments() {
		return $this->asMany(Comment::class);
	}
}
