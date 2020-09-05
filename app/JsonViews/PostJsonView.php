<?php

namespace App\JsonViews;

use Domain\SSN\Posts\ViewModels\PostViewModelInterface;
use JsonSerializable;

class PostJsonView implements JsonSerializable
{
    private PostViewModelInterface $vm;

    public function __construct(PostViewModelInterface $vm)
    {
        $this->vm = $vm;
    }

    public function jsonSerialize()
    {
        return [
            'data' => [
                'attributes' => [
                    'content' => $this->vm->getContent(),
                ]
            ],
            'relationships' => [
                'author' => [
                    'attributes' => [
                        'name' => $this->vm->getAuthorName()
                    ]
                ]
            ]
        ];
    }
}
