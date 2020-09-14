<?php

namespace Domain\SSN\Posts\UseCases\ShowNewsfeed;

use Domain\SSN\Posts\Entity\Post;

class ShowNewsfeedResponse
{
    /**
     * @var array<Post>
     */
    private array $posts;

    /**
     * ShowNewsfeedResponse constructor.
     * @param array $posts
     */
    public function __construct(array $posts)
    {
        $this->posts = $posts;
    }

    /**
     * @return array
     */
    public function getPosts(): array
    {
        return $this->posts;
    }
}
