<?php

namespace App\Presenters\Auth;

use Domain\SSN\Auth\UseCases\Login\LoginPresenterInterface;
use Domain\SSN\Auth\UseCases\Login\LoginResponse;

class LoginPresenter implements LoginPresenterInterface
{
    public function presents(LoginResponse $response): void
    {
    }
}
