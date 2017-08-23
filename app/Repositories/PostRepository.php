<?php

namespace App\Repositories;

use App\Post;

class PostRepository {
    protected $post;

    public function __construct(Post $post) 
    {
        $this->post = $post;
    }

    /**
     * Récupère tous les posts avec $int éléments par page
     *
     * @param int $int
     * @return \Illuminate\Support\Collection
     */
    public function getAllPaginate (int $int)
    {
        return $this->post
                    ->with('user')->withCount('comments')
                    ->orderBy('created_at', 'desc')->paginate($int);
    }

    /**
     * Récupère les $int derniers posts publiés
     *
     * @param int $int
     * @return \Illuminate\Support\Collection
     */
    public function getLastsPublished (int $int)
    {
        return $this->post
                    ->with('user')->withCount('comments')
                    ->orderBy('created_at', 'desc')
                    ->published()->take($int)->get();
    }

    /**
     * Recupère les $int posts les plus commentés
     *
     * @param int $int
     * @return \Illuminate\Support\Collection
     */
    public function getMostCommented (int $int)
    {
        return $this->post
                    ->withCount('comments')
                    ->orderBy('comments_count', 'desc')
                    ->take($int)->get();
    }

    /**
     * Récupère tous les posts publiés avec $int posts par page
     *
     * @param int $int
     * @return \Illuminate\Support\Collection
     */
    public function getAllPublishedPaginate (int $int)
    {
        return $this->post
                    ->with('user')->withCount('comments')
                    ->orderBy('created_at', 'desc')
                    ->published()->paginate($int);
    }

    /**
     * Récupère un post avec user et comments
     *
     * @param int $id
     * @return \App\Post
     */
    public function getOneAllInfos (int $id)
    {
        return $this->post->with('user', 'comments')->findOrFail($id);
    }
}