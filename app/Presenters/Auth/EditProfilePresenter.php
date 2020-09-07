<?php

namespace App\Presenters\Auth;

use Domain\SSN\Auth\UseCases\EditProfile\EditProfilePresenterInterface;
use Domain\SSN\Auth\UseCases\EditProfile\EditProfileResponse;

class EditProfilePresenter implements EditProfilePresenterInterface
{
    public function presents(EditProfileResponse $response): void
    {
    }
}
