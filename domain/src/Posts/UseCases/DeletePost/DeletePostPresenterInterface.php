<?php

namespace Domain\SSN\Posts\UseCases\DeletePost;

interface DeletePostPresenterInterface
{
    public function presents(DeletePostResponse $response): void;
}
