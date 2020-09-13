<?php

namespace Domain\SSN\Users\UseCases\UnfollowUser;

use Domain\SSN\Auth\ViewModels\UserViewModelInterface;

interface UnfollowUserPresenterInterface
{
    public function presents(UnfollowUserResponse $response): void;

    public function getViewModel(): UserViewModelInterface;
}
