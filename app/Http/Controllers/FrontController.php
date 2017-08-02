<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class FrontController extends Controller
{
	public function home()
	{
		$posts = Post::with('user')->withCount('comments')->published()->take(3)->get();
		return view('front.home', compact('posts'));
	}

	public function actus()
	{
		// dd(Post::with('user')->published()->paginate(10));
		$posts = Post::with('user')->withCount('comments')->published()->paginate(5);
		return view('front.actus', compact('posts'));
	}

	public function actu($id)
	{
		$post = Post::with('user', 'comments')->findOrFail($id);
		return view('front.actu', compact('post'));
	}

	public function comment()
	{
		return 'comment';
	}

	public function lycee()
	{
		return view('front.lycee');
	}

	public function contact(Request $request)
	{
		if ($request->isMethod('post'))
        {
        	dd($request);
        }
		return view('front.contact');
	}

	public function mentionslegales()
	{
		return view('front.mentionslegales');
	}

}
