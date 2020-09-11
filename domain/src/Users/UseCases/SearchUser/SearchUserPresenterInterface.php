<?php

namespace Domain\SSN\Users\UseCases\SearchUser;

use Domain\SSN\Users\ViewModels\UserCollectionViewModelInterface;

interface SearchUserPresenterInterface
{
    public function presents(SearchUserResponse $response): void;

    public function getViewModel(): UserCollectionViewModelInterface;
}
