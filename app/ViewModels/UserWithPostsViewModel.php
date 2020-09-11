<?php

namespace App\ViewModels;

use Domain\SSN\Auth\Entity\User;
use Domain\SSN\Users\ViewModels\UserWithPostsViewModelInterface;

class UserWithPostsViewModel implements UserWithPostsViewModelInterface
{
    /**
     * @var User
     */
    private User $user;

    /**
     * @var PostViewModel[]
     */
    private array $posts;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->posts = array_map(fn($post) => new PostViewModel($post), $this->user->getPosts());
    }

    public function getUsername(): string
    {
        return $this->user->getUsername();
    }

    public function getEmail(): string
    {
        return $this->user->getEmail();
    }

    public function getPosts(): array
    {
        return $this->posts;
    }
}
