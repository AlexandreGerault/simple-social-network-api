<?php

namespace App\Presenters\Users;

use App\ViewModels\UserCollectionViewModel;
use Domain\SSN\Users\UseCases\SearchUser\SearchUserPresenterInterface;
use Domain\SSN\Users\UseCases\SearchUser\SearchUserResponse;
use Domain\SSN\Users\ViewModels\UserCollectionViewModelInterface;

class SearchUserPresenter implements SearchUserPresenterInterface
{
    private UserCollectionViewModelInterface $vm;

    public function presents(SearchUserResponse $response): void
    {
        $this->vm = new UserCollectionViewModel($response->getResults());
    }

    public function getViewModel(): UserCollectionViewModelInterface
    {
        return $this->vm;
    }
}
