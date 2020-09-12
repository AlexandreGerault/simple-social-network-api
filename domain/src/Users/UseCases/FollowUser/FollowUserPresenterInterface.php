<?php

namespace Domain\SSN\Users\UseCases\FollowUser;

use Domain\SSN\Auth\ViewModels\UserViewModelInterface;

interface FollowUserPresenterInterface
{
    public function presents(FollowUserResponse $response): void;

    public function getViewModel(): UserViewModelInterface;
}
