<?php

namespace App\Presenters\Auth;

use App\ViewModels\UserViewModel;
use Domain\SSN\Auth\UseCases\Login\LoginPresenterInterface;
use Domain\SSN\Auth\UseCases\Login\LoginResponse;
use Domain\SSN\Auth\ViewModels\UserViewModelInterface;

class LoginPresenter implements LoginPresenterInterface
{
    private UserViewModelInterface $vm;

    public function presents(LoginResponse $response): void
    {
        $this->vm = new UserViewModel($response->getUser());
    }

    public function getViewModel(): UserViewModelInterface
    {
        return $this->vm;
    }
}
