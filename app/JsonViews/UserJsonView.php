<?php

namespace App\JsonViews;

use App\ViewModels\UserViewModel;
use Domain\SSN\Auth\ViewModels\UserViewModelInterface;

class UserJsonView implements JsonViewInterface
{
    private UserViewModelInterface $vm;

    /**
     * UserJsonView constructor.
     * @param UserViewModel $vm
     */
    public function __construct(UserViewModelInterface $vm)
    {
        $this->vm = $vm;
    }


    public function asArray(): array
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
