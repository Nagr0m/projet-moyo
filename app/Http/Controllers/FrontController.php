<?php

namespace App\Http\Controllers;

use View;
use App\Mail\ContactMessage;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\UserInject;
use App\Repositories\PostRepository;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\CommentRequest;
use App\Repositories\ReCaptchaRepository;

class FrontController extends Controller
{
	use UserInject;
	use ReCaptchaRepository;

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
	 * @param \App\Http\Requests\CommentRequest $request
	 * @return \Illuminate\Http\Response
	 */
	public function comment (CommentRequest $request)
	{	
		# Vérification ReCaptcha Google
		if ( !$this->checkCaptcha( $request->input('g-recaptcha-response') ) )
			return redirect()->back()->with('message', 'La vérification anti-spam a échouée')->withInputs();
		
		# Enregistrement du commentaire
		$post = \App\Post::find($request->post_id);
		$post->comments()->create($request->all());

		return redirect()->to(route('actu', $request->post_id) . '#commentaires')->with('message', 'Votre commentaire a bien été enregistré');
	}

	/**
	 * Contact form handling
	 *
	 * @param ContactRequest $request
	 * @return \Illuminate\Http\Response
	 */
	public function contactSend (ContactRequest $request)
	{
		# Vérification ReCaptcha Google
		if ( !$this->checkCaptcha( $request->input('g-recaptcha-response') ) )
			return redirect()->back()->with('message', 'La vérification anti-spam a échouée')->withInputs();
		
		$datas = [
			'email'   => $request->email,
			'name'    => $request->name,
			'content' => $request->content
		];
		
		Mail::to(env('MAIL_ADMIN_EMAIL'))->send(new ContactMessage($datas));

		return redirect()->back()->with('message', "Votre message a bien été envoyé");
	}

	/**
	 * Login Page
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function loginPage ()
	{	
		# Redirection automatique si déjà loggué
        if (\Auth::check())
        {
            if (\Auth::user()->role === 'teacher')
                return redirect()->route('teacher/home');
            
            return redirect()->route('student/home');
		}
		
		return view('login');
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
	 * Contact page
	 *
	 * @return \Illuminate\Http\response
	 */
	public function contactPage ()
	{
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