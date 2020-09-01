<?php

namespace Domain\SSN\Posts\UseCases\CreatePost;

interface CreatePostPresenterInterface
{
    public function presents(CreatePostResponse $response);
}
