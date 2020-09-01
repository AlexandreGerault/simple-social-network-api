<?php

namespace App\Presenters\Auth;

use Domain\SSN\Auth\UseCases\Registration\RegistrationPresenterInterface;
use Domain\SSN\Auth\UseCases\Registration\RegistrationResponse;

class RegistrationPresenter implements RegistrationPresenterInterface
{
    public function presents(RegistrationResponse $response): void
    {
    }
}
