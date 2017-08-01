<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class FrontController extends Controller
{
	public function home()
	{
		$robots = Post::with('user')->published()->take(3)->get();
		dd($robots[0]);
		return view('front.home');
	}
}
