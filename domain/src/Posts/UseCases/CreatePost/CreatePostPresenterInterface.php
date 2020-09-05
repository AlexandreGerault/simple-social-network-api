<?php

namespace Domain\SSN\Posts\UseCases\CreatePost;

use Domain\SSN\Posts\ViewModels\PostViewModelInterface;

interface CreatePostPresenterInterface
{
    public function presents(CreatePostResponse $response);

    public function getViewModel(): PostViewModelInterface;
}
