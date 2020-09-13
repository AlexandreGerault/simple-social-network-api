<?php

namespace App\Presenters\Users;

use App\ViewModels\UserViewModel;
use Domain\SSN\Auth\ViewModels\UserViewModelInterface;
use Domain\SSN\Users\UseCases\UnfollowUser\UnfollowUserPresenterInterface;
use Domain\SSN\Users\UseCases\UnfollowUser\UnfollowUserResponse;

class UnfollowUserPresenter implements UnfollowUserPresenterInterface
{
    private UserViewModelInterface $vm;

    public function presents(UnfollowUserResponse $response): void
    {
        $this->vm = new UserViewModel($response->getAuthenticated());
    }

    public function getViewModel(): UserViewModelInterface
    {
        return $this->vm;
    }
}
