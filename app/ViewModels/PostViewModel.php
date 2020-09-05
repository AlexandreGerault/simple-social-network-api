<?php

namespace App\ViewModels;

use Domain\SSN\Posts\Entity\Post;
use Domain\SSN\Posts\ViewModels\PostViewModelInterface;

class PostViewModel implements PostViewModelInterface
{
    private string $content;
    private string $authorName;

    public function __construct(Post $post)
    {
        $this->content = $post->getContent();
        $this->authorName = $post->getAuthor()->getUsername();
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getAuthorName(): string
    {
        return $this->authorName;
    }
}
