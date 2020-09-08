<?php

namespace Domain\SSN\Users\ViewModels;

use Domain\SSN\Auth\ViewModels\UserViewModelInterface;

interface UserCollectionViewModelInterface
{
    /**
     * @return UserViewModelInterface[]
     */
    public function getUsers(): array;
}
