<?php

namespace Domain\SSN\Users\UseCases\ShowUser;

use Domain\SSN\Users\ViewModels\UserWithPostsViewModelInterface;

interface ShowUserPresenterInterface
{
    public function presents(ShowUserResponse $response): void;

    public function getViewModel(): UserWithPostsViewModelInterface;
}
