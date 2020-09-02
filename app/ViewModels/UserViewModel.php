<?php

namespace App\ViewModels;

use Domain\SSN\Auth\Entity\User;
use Domain\SSN\Auth\ViewModels\UserViewModelInterface;

class UserViewModel implements UserViewModelInterface
{
    private string $username;
    private string $email;

    public function __construct(User $user)
    {
        $this->username = $user->getUsername();
        $this->email = $user->getEmail();
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }
}
