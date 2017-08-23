<?php

namespace App;

use URL;
use App\Presenters\CommonDatePresenter;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	use CommonDatePresenter;

    protected $dates 	= ['created_at', 'updated_at'];
    protected $fillable = ['title', 'content', 'abstract', 'thumbnail', 'published', 'user_id'];

	public function user() 
	{
		return $this->belongsTo(User::class);
	}
	public function comments() 
	{
		return $this->hasMany(Comment::class);
	}

	public function getUrlThumbnailAttribute ()
	{
		return ($this->thumbnail) ? URL::asset('img/posts/' . $this->thumbnail) : null;
	}
	
	public function getSmallThumbnailAttribute ()
	{
		return ($this->thumbnail) ? URL::asset('img/posts/square_' . $this->thumbnail) : null;
	}

	public function setTitleAttribute($value)
	{
		$this->attributes['title']= $value;
		$this->attributes['slug'] = str_slug($value);
	}

	public function scopePublished($query) 
	{
		return $query->where('published', true)->orderby('created_at', 'DESC');
	}
}
