<?php

namespace Domain\SSN\Posts\UseCases\ShowNewsfeed;

use Domain\SSN\Posts\ViewModels\PostCollectionViewModelInterface;

interface ShowNewsfeedPresenterInterface
{
    public function presents(ShowNewsfeedResponse $response): void;

    public function getViewModel(): PostCollectionViewModelInterface;
}
