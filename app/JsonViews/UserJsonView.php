<?php

namespace App\JsonViews;

use Domain\SSN\Auth\ViewModels\UserViewModelInterface;
use JsonSerializable;

class UserJsonView implements JsonSerializable
{
    private UserViewModelInterface $vm;

    /**
     * UserJsonView constructor.
     * @param UserViewModelInterface $vm
     */
    public function __construct(UserViewModelInterface $vm)
    {
        $this->vm = $vm;
    }

    public function jsonSerialize()
    {
        return [
            'data' => [
                'attributes' => [
                    'username' => $this->vm->getUsername(),
                    'email' => $this->vm->getEmail()
                ]
            ]
        ];
    }
}
