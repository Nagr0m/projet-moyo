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

	/**
	 * Home page
	 *
	 * @param \App\Repositories\PostRepository $PostRepository
	 * @return \Illuminate\Http\Response
	 */
	public function home (PostRepository $PostRepository)
	{	
		$posts = $PostRepository->getLastsPublishedWithPic(4);
		return view('front.home', compact('posts'));
	}

	/**
	 * Published posts index
	 *
	 * @param \App\Repositories\PostRepository $PostRepository
	 * @return \Illuminate\Http\Response
	 */
	public function postsIndex (PostRepository $PostRepository)
	{	
		$posts = $PostRepository->getAllPublishedPaginate(5);
		return view('front.actus', compact('posts'));
	}

	/**
	 * Single post page
	 *
	 * @param \App\Repositories\PostRepository $PostRepository
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function postSingle (PostRepository $PostRepository, int $id)
	{	
		$post = $PostRepository->getOneAllInfos($id);
		return view('front.actu', compact('post'));
	}

	/**
	 * Post a new comment
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
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

		return redirect()->to(route('actu', $request->post_id) . '#commentaires')->with('message', 'Votre commentaire a bien été enregistré');
	}

	/**
	 * High school static page
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function lycee()
	{
		return view('front.lycee');
	}

	/**
	 * Contact page & form handling
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\response
	 */
	public function contact(Request $request)
	{
		if ($request->isMethod('post'))
        {	
			$this->validate($request, [
				'name'    => 'required|string',
				'email'   => 'required|email',
				'content' => 'required|string'
			], [
				'required' => "Ce champ est requis",
				'email'	   => "Email invalide"
			]);

        	dd($request);
        }
		return view('front.contact');
	}

	/**
	 * Legals static page
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function mentionslegales()
	{
		return view('front.mentionslegales');
	}

}
