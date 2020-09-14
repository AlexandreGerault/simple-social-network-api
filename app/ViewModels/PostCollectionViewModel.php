<?php

namespace App\ViewModels;

use Domain\SSN\Posts\ViewModels\PostCollectionViewModelInterface;
use Domain\SSN\Posts\ViewModels\PostViewModelInterface;

class PostCollectionViewModel implements PostCollectionViewModelInterface
{
    /**
     * @var array<PostViewModelInterface>
     */
    private array $posts;

    /**
     * PostCollectionViewModel constructor.
     * @param array<PostViewModelInterface> $posts
     */
    public function __construct(array $posts)
    {
        $this->posts = $posts;
    }

    /**
     * @return array<PostViewModelInterface>
     */
    public function getPostViewModelInterfaces(): array
    {
        return $this->posts;
    }
}
