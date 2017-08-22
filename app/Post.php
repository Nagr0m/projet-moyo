<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Presenters\DatePresenter;

class Post extends Model
{
    use DatePresenter;

    protected $dates = ['created_at', 'updated_at'];

    protected $fillable = ['title', 'content', 'abstract', 'url_thumbnail', 'published', 'user_id'];

	public function user() {
		return $this->belongsTo(User::class);
	}

	public function comments() {
		return $this->hasMany(Comment::class);
	}

	public function scopePublished($query) {
		return $query->where('published', true)->orderby('created_at', 'DESC');
	}
}
