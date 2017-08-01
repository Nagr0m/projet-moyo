<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class FrontController extends Controller
{
	public function home()
	{
		$posts = Post::with('user')->published()->take(3)->get();
		return view('front.home', compact('posts'));
	}
}
