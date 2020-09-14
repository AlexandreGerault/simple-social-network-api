<?php

namespace Domain\Tests\Adapters\Repositories;

use Domain\SSN\Auth\Entity\User;
use Domain\SSN\Auth\Gateway\AuthenticationGateway;

class AuthenticatedUserProvider implements AuthenticationGateway
{
    private User $authenticatedUser;

    /**
     * AuthenticatedUserProvider constructor.
     * @param User $authenticatedUser
     */
    public function __construct(User $authenticatedUser)
    {
        $this->authenticatedUser = $authenticatedUser;
    }

    public function getAuthenticatedUser(): User
    {
        return $this->authenticatedUser;
    }
}
