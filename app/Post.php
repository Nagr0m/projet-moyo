<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $dates = ['created_at', 'updated_at'];

    protected $fillable = ['title', 'content', 'abstract', 'url_thumbnail', 'published', 'user_id'];

	public function user() {
		return $this->belongsTo(User::class);
	}

	public function comments() {
		return $this->hasMany(Comment::class);
	}

	public function setTitleAttribute($value)
	{
		$this->attributes['title']= $value;
		$this->attributes['slug'] = str_slug($value);
	}

	public function scopePublished($query) {
		return $query->where('published', true)->orderby('created_at', 'DESC');
	}
}
