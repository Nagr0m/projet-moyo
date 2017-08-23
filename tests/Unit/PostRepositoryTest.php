<?php

namespace Tests\Unit;

use Tests\TestCase;

class PostRepositoryTest extends TestCase {

    /**
     * Undocumented function
     *
     * @param App\Post $post
     * @return void
     */
    public function testAllPostsWithCommentsPaginateTest ()
    {   
        $post = new \App\Post;
        $PostRepository = new \App\Repositories\PostRepository($post);
        $result = $PostRepository->getAllPostsWithCommentsPaginate(3);

        $this->assertEquals(count($result), 3);
    }
}