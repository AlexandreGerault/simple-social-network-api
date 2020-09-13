<?php

namespace Domain\SSN\Users\UseCases\UnfollowUser;

use Domain\SSN\Auth\Entity\User;

class UnfollowUserResponse
{
    private User $authenticated;

    /**
     * UnfollowUserResponse constructor.
     * @param User $authenticated
     */
    public function __construct(User $authenticated)
    {
        $this->authenticated = $authenticated;
    }

    /**
     * @return User
     */
    public function getAuthenticated(): User
    {
        return $this->authenticated;
    }
}
