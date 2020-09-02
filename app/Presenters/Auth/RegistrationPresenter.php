<?php

namespace App\Presenters\Auth;

use App\ViewModels\UserViewModel;
use Domain\SSN\Auth\UseCases\Registration\RegistrationPresenterInterface;
use Domain\SSN\Auth\UseCases\Registration\RegistrationResponse;
use Domain\SSN\Auth\ViewModels\UserViewModelInterface;

class RegistrationPresenter implements RegistrationPresenterInterface
{
    private UserViewModelInterface $vm;

    public function presents(RegistrationResponse $response): void
    {
        $this->vm = new UserViewModel($response->getUser());
    }

    public function getViewModel(): UserViewModelInterface
    {
        return $this->vm;
    }
}
