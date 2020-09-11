<?php

namespace App\JsonViews;

use Domain\SSN\Users\ViewModels\UserWithPostsViewModelInterface;
use JsonSerializable;

class UserWithPostsJsonView implements JsonSerializable
{
    private UserWithPostsViewModelInterface $vm;

    /**
     * UserWithPostsJsonView constructor.
     * @param UserWithPostsViewModelInterface $vm
     */
    public function __construct(UserWithPostsViewModelInterface $vm)
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
                ],
                'relationships' => [
                    'posts' => array_map(function ($postVm) {
                        return [
                            'content' => $postVm->getContent(),
                        ];
                    }, $this->vm->getPosts())
                ]
            ]
        ];
    }
}
