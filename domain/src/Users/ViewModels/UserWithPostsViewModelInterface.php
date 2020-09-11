<?php


namespace Domain\SSN\Users\ViewModels;


use Domain\SSN\Auth\Entity\User;
use Domain\SSN\Posts\ViewModels\PostViewModelInterface;

interface UserWithPostsViewModelInterface
{
    public function __construct(User $user);

    public function getUsername(): string;

    public function getEmail(): string;

    /**
     * @return PostViewModelInterface[]
     */
    public function getPosts(): array;
}
