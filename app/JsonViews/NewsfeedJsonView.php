<?php

namespace App\JsonViews;

use Domain\SSN\Posts\ViewModels\PostCollectionViewModelInterface;
use JsonSerializable;

class NewsfeedJsonView implements JsonSerializable
{
    private PostCollectionViewModelInterface $vm;

    /**
     * NewsfeedJsonView constructor.
     * @param PostCollectionViewModelInterface $vm
     */
    public function __construct(PostCollectionViewModelInterface $vm)
    {
        $this->vm = $vm;
    }

    public function jsonSerialize()
    {
        return [
            "data" => array_map(fn($vm) => [
                "content" => $vm->getContent()
            ], $this->vm->getPostViewModelInterfaces())
        ];
    }
}
