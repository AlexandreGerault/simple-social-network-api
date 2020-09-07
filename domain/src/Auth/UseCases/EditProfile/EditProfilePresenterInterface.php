<?php

namespace Domain\SSN\Auth\UseCases\EditProfile;

use Domain\SSN\Auth\ViewModels\UserViewModelInterface;

interface EditProfilePresenterInterface
{
    public function presents(EditProfileResponse $response): void;

    public function getViewModel(): UserViewModelInterface;
}
