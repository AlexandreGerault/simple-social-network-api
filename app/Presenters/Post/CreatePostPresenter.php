<?php

namespace App\Presenters\Post;

use App\ViewModels\PostViewModel;
use Domain\SSN\Posts\UseCases\CreatePost\CreatePostPresenterInterface;
use Domain\SSN\Posts\UseCases\CreatePost\CreatePostResponse;
use Domain\SSN\Posts\ViewModels\PostViewModelInterface;

class CreatePostPresenter implements CreatePostPresenterInterface
{
    private PostViewModelInterface $vm;

    public function presents(CreatePostResponse $response)
    {
        $this->vm = new PostViewModel($response->getPost());
    }

    public function getViewModel(): PostViewModelInterface
    {
        return $this->vm;
    }
}
