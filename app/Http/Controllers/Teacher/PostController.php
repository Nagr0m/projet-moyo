<?php

namespace App\Http\Controllers\Teacher;

use File;
use Image;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\UserInject;
use App\Http\Controllers\Controller;

class PostController extends Controller
{   
    use UserInject;

    public function __construct ()
    {
        $this->setUser();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $posts = Post::orderBy('created_at', 'desc')->get();

        return view('teacher.posts_index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teacher.posts_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {   
        # Traitement de l'image
        if ($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid())
        {   
            $Image = Image::make($request->thumbnail)->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio(); # Respecte le ratio
                $constraint->upsize(); # Évite le upsize si image plus petite que 800*800
            });
            
            $imgName = str_random(12) . '.' . $request->thumbnail->extension();
            $imgPath = public_path('img/posts/') . $imgName;
            $imgURL  = '/img/posts/' . $imgName;
            
            $Image->save($imgPath, 100);
        }
        # Enregistrement de l'article
        Post::create([
            'title'         => $request->title,
            'content'       => $request->content,
            'url_thumbnail' => isset($imgURL) ? $imgURL : null,
            'abstract'      => isset($request->abstract) ? $request->abstract: '',
            'user_id'       => $request->user()->id
        ]);

        return redirect()->route('posts.index')->with('message', 'L\'article a bien été créé');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('teacher.posts_edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PostRequest  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {   
        $imgURL = $post->url_thumbnail;

        # Traitement de l'ancienne image
        if ($post->url_thumbnail && is_null($request->oldThumbnail) && File::exists(public_path($post->url_thumbnail)))
        {
            File::delete(public_path($post->url_thumbnail));
            $imgURL = null;
        }

        # Traitement de l'image
        if ($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid())
        {
            $Image = Image::make($request->thumbnail)->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio(); # Respecte le ratio
                $constraint->upsize(); # Évite le upsize si image plus petite que 800*800
            });
            
            $imgName = str_random(12) . '.' . $request->thumbnail->extension();
            $imgPath = public_path('img/posts/') . $imgName;
            $imgURL  = '/img/posts/' . $imgName;
            
            $Image->save($imgPath, 100);
        }

        # Mise à jour de l'article
        $post->update([
            'title'         => $request->title,
            'content'       => $request->content,
            'url_thumbnail' => $imgURL,
            'abstract'      => $request->abstract
        ]);

        return redirect()->route('posts.index')->with('message', 'L\'article a été mis à jour');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
