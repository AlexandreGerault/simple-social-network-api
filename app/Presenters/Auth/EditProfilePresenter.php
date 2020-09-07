<?php

namespace App\Presenters\Auth;

use App\ViewModels\UserViewModel;
use Domain\SSN\Auth\UseCases\EditProfile\EditProfilePresenterInterface;
use Domain\SSN\Auth\UseCases\EditProfile\EditProfileResponse;
use Domain\SSN\Auth\ViewModels\UserViewModelInterface;

class EditProfilePresenter implements EditProfilePresenterInterface
{
    private UserViewModelInterface $vm;

    public function presents(EditProfileResponse $response): void
    {
        $this->vm = new UserViewModel($response->getUser());
    }

    public function getViewModel(): UserViewModelInterface
    {
        return $this->vm;
    }
}
