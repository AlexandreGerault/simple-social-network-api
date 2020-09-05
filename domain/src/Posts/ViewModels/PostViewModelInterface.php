<?php

namespace Domain\SSN\Posts\ViewModels;

use Domain\SSN\Posts\Entity\Post;

interface PostViewModelInterface
{
    public function __construct(Post $post);

    public function getContent(): string;

    public function getAuthorName(): string;
}
