<?php

namespace Domain\SSN\Auth\UseCases\Registration;

use Domain\SSN\Auth\Entity\User;

class RegistrationResponse
{
    private User $user;

    /**
     * RegistrationResponse constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }
}
