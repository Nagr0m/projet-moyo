<?php

namespace App\Http\Controllers\Teacher;

use App\Post;
use App\Http\Requests\PostRequest;
use App\Repositories\PostRepository;
use App\Http\Controllers\UserInject;
use App\Http\Controllers\Controller;
use App\Repositories\PostImgRepository;
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
     * @param \App\Repositories\PostRepository $PostRepository
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
     * @param  \App\Repositories\PostImgRepository $PostImgRepository
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request, PostImgRepository $PostImgRepository)
    {   
        # Traitement de l'image
        if ($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid())
        {   
            $imgName = $PostImgRepository->saveThumbnail($request->thumbnail); 
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
     * @param  \App\Repositories\PostImgRepository $PostImgRepository
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post, PostImgRepository $PostImgRepository)
    {   
        $imgName = $post->thumbnail;

        # Traitement de l'ancienne image
        if ($post->thumbnail && is_null($request->oldThumbnail))
        {   
            $PostImgRepository->destroyThumbnail($imgName);
            $imgName = null;
        }

        # Traitement de l'image
        if ($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid())
        {
            $imgName = $PostImgRepository->saveThumbnail($request->thumbnail);
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
     * @param  \App\Post $post
     * @param \App\Repositories\PostImgRepository $PostImgRepository
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post, PostImgRepository $PostImgRepository)
    {   
        if ($post->thumbnail)
        {
            $PostImgRepository->destroyThumbnail($post->thumbnail);
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
            $this->massPostDelete($request->items, new PostImgRepository());
            $message = 'Les articles ont été supprimés';
        }
        else 
        {
            Post::whereIn('id', $request->items)->update(['published' => ($request->operation === 'publish')]);
            $message = 'Le statut des articles a été mis à jour';
        }

        return redirect()->route('posts.index')->with('message', $message);
    }

    /**
     * Suppression de masse de posts et d'images associées
     *
     * @param array $items
     * @param \App\Repositories\PostImgRepository $PostImgRepository
     * @return void
     */
    public function massPostDelete (array $items, PostImgRepository $PostImgRepository)
    {
        foreach ($items as $id)
        {
            $post = Post::find($id);
            if ($post->thumbnail)
                $PostImgRepository->destroyThumbnail($post->thumbnail);
            
            $post->delete();
        }
    }
}