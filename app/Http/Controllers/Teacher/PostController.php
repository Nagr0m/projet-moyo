<?php

namespace App\Http\Controllers\Teacher;

use File;
use Image;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Repositories\PostRepository;
use App\Http\Controllers\UserInject;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassUpdateRequest;

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
    public function index(PostRepository $postRepository)
    {   
        $posts = $postRepository->getAllPaginate(5);

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
            $Image = Image::make($request->thumbnail)->resize(env('THUMBNAIL_SIZE', 800), env('THUMBNAIL_SIZE', 800), function ($constraint) {
                $constraint->aspectRatio(); # Respecte le ratio
                $constraint->upsize(); # Évite le upsize si image plus petite que 800*800
            });
            
            $imgName = str_random(12) . '.' . $request->thumbnail->extension();
            $imgPath = public_path('img/posts/') . $imgName;
            $imgURL  = '/img/posts/' . $imgName;

            # Square thumbnail
            $squarePath = public_path('img/posts/square_') . $imgName;
            $Image->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->crop(200, 200)->save($squarePath, 100);
            
            $Image->save($imgPath, 100);
        }
        # Enregistrement de l'article
        Post::create([
            'title'         => $request->title,
            'content'       => $request->content,
            'thumbnail'     => isset($imgName) ? $imgName : null,
            'abstract'      => isset($request->abstract) ? $request->abstract: '',
            'user_id'       => $request->user()->id,
            'published'     => $request->published
        ]);

        return redirect()->route('posts.index')->with('message', 'L\'article a bien été créé');
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
        $imgName = $post->thumbnail;

        # Traitement de l'ancienne image
        if ($post->thumbnail && is_null($request->oldThumbnail))
        {
            if (File::exists(public_path($post->thumbnail)))
                File::delete(public_path($post->thumbnail));
            
            $imgName = null;
        }

        # Traitement de l'image
        if ($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid())
        {
            $Image = Image::make($request->thumbnail)->resize(env('THUMBNAIL_SIZE', 800), env('THUMBNAIL_SIZE', 800), function ($constraint) {
                $constraint->aspectRatio(); # Respecte le ratio
                $constraint->upsize(); # Évite le upsize si image plus petite que 800*800
            });
            
            $imgName = str_random(12) . '.' . $request->thumbnail->extension();
            $imgPath = public_path('img/posts/') . $imgName;
            $imgURL  = '/img/posts/' . $imgName;

            # Square thumbnail
            $squarePath = public_path('img/posts/square_') . $imgName;
            $Image->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->crop(200, 200)->save($squarePath, 100);
            
            $Image->save($imgPath, 100);
        }

        # Mise à jour de l'article
        $post->update([
            'title'         => $request->title,
            'content'       => $request->content,
            'thumbnail'     => $imgName,
            'abstract'      => $request->abstract,
            'published'     => $request->published
        ]);
            
        return redirect()->route('posts.index')->with('message', 'L\'article a été mis à jour');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {   
        if ($post->url_thumbnail && File::exists(public_path($post->url_thumbnail)))
        {
            File::delete(public_path($post->url_thumbnail));
        }

        $post->delete();

        return redirect()->route('posts.index')->with('message', 'L\'article a été supprimé');
    }

    /**
     * Mass posts updating
     *
     * @param \App\Http\Requests\MassUpdateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function multiplePatch (MassUpdateRequest $request)
    {
        if ($request->operation === 'delete')
        {
            Post::destroy($request->items);
            $message = 'Les articles ont été supprimés';
        }
        else 
        {
            Post::whereIn('id', $request->items)->update(['published' => ($request->operation === 'publish')]);
            $message = 'Le statut des articles a été mis à jour';
        }

        return redirect()->route('posts.index')->with('message', $message);
    }
}