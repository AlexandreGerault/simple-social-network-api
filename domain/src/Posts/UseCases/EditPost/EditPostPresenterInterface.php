<?php

namespace Domain\SSN\Posts\UseCases\EditPost;

interface EditPostPresenterInterface
{
    public function presents(EditPostResponse $response): void;
}
