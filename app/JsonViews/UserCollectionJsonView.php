<?php

namespace App\JsonViews;

use Domain\SSN\Users\ViewModels\UserCollectionViewModelInterface;
use JsonSerializable;

class UserCollectionJsonView implements JsonSerializable
{
    private UserCollectionViewModelInterface $vm;

    /**
     * UserCollectionJsonView constructor.
     * @param UserCollectionViewModelInterface $vm
     */
    public function __construct(UserCollectionViewModelInterface $vm)
    {
        $this->vm = $vm;
    }

    public function jsonSerialize()
    {
        return [
            "data" => array_map(fn ($userVm) => [
                "attributes" => [
                    "username" => $userVm->getUsername(),
                    "email" => $userVm->getEmail()
                ]
            ], $this->vm->getUsers())
        ];
    }
}
