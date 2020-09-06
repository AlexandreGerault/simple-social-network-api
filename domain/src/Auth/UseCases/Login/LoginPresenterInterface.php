<?php

namespace Domain\SSN\Auth\UseCases\Login;

use Domain\SSN\Auth\ViewModels\UserViewModelInterface;

interface LoginPresenterInterface
{
    public function presents(LoginResponse $response): void;

    public function getViewModel(): UserViewModelInterface;
}
