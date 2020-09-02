<?php

namespace App\Presenters\Post;

use Domain\SSN\Posts\UseCases\CreatePost\CreatePostPresenterInterface;
use Domain\SSN\Posts\UseCases\CreatePost\CreatePostResponse;

class CreatePostPresenter implements CreatePostPresenterInterface
{
    public function presents(CreatePostResponse $response)
    {
    }
}
