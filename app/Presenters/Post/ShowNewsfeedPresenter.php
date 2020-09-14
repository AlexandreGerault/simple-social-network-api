<?php

namespace App\Presenters\Post;

use App\ViewModels\PostCollectionViewModel;
use App\ViewModels\PostViewModel;
use Domain\SSN\Posts\UseCases\ShowNewsfeed\ShowNewsfeedPresenterInterface;
use Domain\SSN\Posts\UseCases\ShowNewsfeed\ShowNewsfeedResponse;
use Domain\SSN\Posts\ViewModels\PostCollectionViewModelInterface;

class ShowNewsfeedPresenter implements ShowNewsfeedPresenterInterface
{
    private PostCollectionViewModelInterface $vm;

    public function presents(ShowNewsfeedResponse $response): void
    {
        $this->vm = new PostCollectionViewModel(array_map(fn ($post) => new PostViewModel($post), $response->getPosts()));
    }

    public function getViewModel(): PostCollectionViewModelInterface
    {
        return $this->vm;
    }
}
