<?php

namespace Domain\SSN\Posts\UseCases\CreatePost;

use Domain\SSN\Posts\Entity\Post;

class CreatePostResponse
{
    private Post $post;

    /**
     * CreatePostResponse constructor.
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * @return Post
     */
    public function getPost(): Post
    {
        return $this->post;
    }
}
