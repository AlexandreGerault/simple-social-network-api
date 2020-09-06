<?php

namespace Domain\SSN\Posts\UseCases\EditPost;

use Domain\SSN\Posts\ViewModels\PostViewModelInterface;

interface EditPostPresenterInterface
{
    public function presents(EditPostResponse $response): void;

    public function getViewModel(): PostViewModelInterface;
}
