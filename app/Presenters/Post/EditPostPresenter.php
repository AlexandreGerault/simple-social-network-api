<?php

namespace App\Presenters\Post;

use Domain\SSN\Posts\UseCases\EditPost\EditPostPresenterInterface;
use Domain\SSN\Posts\UseCases\EditPost\EditPostResponse;

class EditPostPresenter implements EditPostPresenterInterface
{
    public function presents(EditPostResponse $response): void
    {
    }
}
