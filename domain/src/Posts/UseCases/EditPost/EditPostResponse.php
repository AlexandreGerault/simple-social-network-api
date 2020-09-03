<?php

namespace Domain\SSN\Posts\UseCases\EditPost;

use Domain\SSN\Posts\Entity\Post;

class EditPostResponse
{
    private Post $post;

    /**
     * EditPostResponse constructor.
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
