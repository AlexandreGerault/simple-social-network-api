<?php


namespace Domain\SSN\Auth\UseCases\Login;


use Domain\SSN\Auth\Entity\User;

class LoginResponse
{
    private User $user;

    /**
     * LoginResponse constructor.
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
