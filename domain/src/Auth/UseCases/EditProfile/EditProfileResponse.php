<?php

namespace Domain\SSN\Auth\UseCases\EditProfile;

use Domain\SSN\Auth\Entity\User;

class EditProfileResponse
{
    private User $user;

    /**
     * EditProfileResponse constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUser(): User
    {
        return $this->user;
    }
}
