<?php

namespace Domain\SSN\Auth\ViewModels;

use Domain\SSN\Auth\Entity\User;

interface UserViewModelInterface
{
    public function __construct(User $user);

    public function getUsername(): string;

    public function getEmail(): string;
}
