<?php

namespace Domain\SSN\Posts\ViewModels;

interface PostCollectionViewModelInterface
{
    /**
     * @return array<PostViewModelInterface>
     */
    public function getPostViewModelInterfaces(): array;
}
