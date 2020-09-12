<?php

namespace Domain\SSN\Users\UseCases\FollowUser;

use Domain\SSN\Auth\Entity\User;

class FollowUserResponse
{
    private User $user;

    /**
     * FollowUserResponse constructor.
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
