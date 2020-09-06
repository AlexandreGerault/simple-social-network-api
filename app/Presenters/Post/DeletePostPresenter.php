<?php

namespace App\Presenters\Post;

use Domain\SSN\Posts\UseCases\DeletePost\DeletePostPresenterInterface;
use Domain\SSN\Posts\UseCases\DeletePost\DeletePostResponse;

class DeletePostPresenter implements DeletePostPresenterInterface
{
    public function presents(DeletePostResponse $response): void
    {
    }
}
