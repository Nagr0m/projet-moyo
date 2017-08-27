<?php

namespace App\Http\Controllers;

use Auth;
use View;
use Illuminate\Http\Request;
use App\Repositories\PostRepository;
use App\Http\Controllers\UserInject;

class FrontController extends Controller
{
	use UserInject;

	public function __construct (PostRepository $PostRepository)
	{
		$this->setUser();
		View::share('mostCommentedPosts', $PostRepository->getMostCommented(3));
	}

	public function home (PostRepository $PostRepository)
	{	
		$posts = $PostRepository->getLastsPublishedWithPic(4);
		return view('front.home', compact('posts'));
	}

	public function postsIndex (PostRepository $PostRepository)
	{	
		$posts = $PostRepository->getAllPublishedPaginate(5);
		return view('front.actus', compact('posts'));
	}

	public function postSingle (PostRepository $PostRepository, int $id)
	{	
		$post = $PostRepository->getOneAllInfos($id);
		return view('front.actu', compact('post'));
	}

	public function comment (Request $request)
	{	
		$this->validate($request, [
			'name'    => 'required|string',
			'content' => 'required|string',
			'post_id' => 'required'
		]);

		# Vérification ReCaptcha Google
		$apiURL = "https://www.google.com/recaptcha/api/siteverify?secret="
				   . env('RECAPTCHA_SECRET')
				   . "&response=" . $request->input('g-recaptcha-response')
				   . "&remoteip=" . $_SERVER['REMOTE_ADDR'];
		$response = json_decode(file_get_contents($apiURL), true);
		if ($response['success'] === false)
			return redirect()->back()->with('message', 'La vérification anti-spam a échouée')->withInputs();
		
		# Enregistrement du commentaire
		$post = \App\Post::find($request->post_id);
		$post->comments()->create($request->all());

		return redirect()->back()->with('message', 'Votre commentaire a été enregistré');
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
