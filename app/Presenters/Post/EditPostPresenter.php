<?php

namespace App\Presenters\Post;

use App\ViewModels\PostViewModel;
use Domain\SSN\Posts\UseCases\EditPost\EditPostPresenterInterface;
use Domain\SSN\Posts\UseCases\EditPost\EditPostResponse;
use Domain\SSN\Posts\ViewModels\PostViewModelInterface;

class EditPostPresenter implements EditPostPresenterInterface
{

    private PostViewModelInterface $vm;

    public function presents(EditPostResponse $response): void
    {
        $this->vm = new PostViewModel($response->getPost());
    }

    public function getViewModel(): PostViewModelInterface
    {
        return $this->vm;
    }
}
