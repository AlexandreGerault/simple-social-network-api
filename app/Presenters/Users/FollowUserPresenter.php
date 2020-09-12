<?php

namespace App\Presenters\Users;

use App\ViewModels\UserViewModel;
use Domain\SSN\Auth\ViewModels\UserViewModelInterface;
use Domain\SSN\Users\UseCases\FollowUser\FollowUserPresenterInterface;
use Domain\SSN\Users\UseCases\FollowUser\FollowUserResponse;

class FollowUserPresenter implements FollowUserPresenterInterface
{
    private UserViewModelInterface $vm;

    public function presents(FollowUserResponse $response): void
    {
        $this->vm = new UserViewModel($response->getUser());
    }

    public function getViewModel(): UserViewModelInterface
    {
        return $this->vm;
    }
}
