<?php

namespace Domain\SSN\Users\UseCases\ShowUser;

use Domain\SSN\Auth\Entity\User;

class ShowUserResponse
{
    private User $userToShow;

    /**
     * ShowUserResponse constructor.
     * @param User $userToShow
     */
    public function __construct(User $userToShow)
    {
        $this->userToShow = $userToShow;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->userToShow;
    }
}
