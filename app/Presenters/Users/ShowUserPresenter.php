<?php

namespace App\Presenters\Users;

use App\ViewModels\UserWithPostsViewModel;
use Domain\SSN\Users\UseCases\ShowUser\ShowUserPresenterInterface;
use Domain\SSN\Users\UseCases\ShowUser\ShowUserResponse;
use Domain\SSN\Users\ViewModels\UserWithPostsViewModelInterface;

class ShowUserPresenter implements ShowUserPresenterInterface
{
    private UserWithPostsViewModelInterface $vm;

    public function presents(ShowUserResponse $response): void
    {
        $this->vm = new UserWithPostsViewModel($response->getUser());
    }

    public function getViewModel(): UserWithPostsViewModelInterface
    {
        return $this->vm;
    }
}
