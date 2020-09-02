<?php

namespace Domain\SSN\Auth\UseCases\Registration;

use Domain\SSN\Auth\ViewModels\UserViewModelInterface;

interface RegistrationPresenterInterface
{
    public function presents(RegistrationResponse $response): void;

    public function getViewModel(): UserViewModelInterface;
}
