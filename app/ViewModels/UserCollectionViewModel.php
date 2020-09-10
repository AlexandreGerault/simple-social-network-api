<?php

namespace App\ViewModels;

use Domain\SSN\Users\ViewModels\UserCollectionViewModelInterface;

class UserCollectionViewModel implements UserCollectionViewModelInterface
{
    private array $users;

    /**
     * UserCollectionViewModel constructor.
     * @param array $users
     */
    public function __construct(array $users)
    {
        $this->users = $users;
    }

    public function getUsers(): array
    {
        return $this->users;
    }
}
