<?php

namespace Domain\SSN\Auth\UseCases\EditProfile;

interface EditProfilePresenterInterface
{
    public function presents(EditProfileResponse $response): void;
}
