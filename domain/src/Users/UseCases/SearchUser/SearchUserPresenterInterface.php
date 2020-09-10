<?php

namespace Domain\SSN\Users\UseCases\SearchUser;

interface SearchUserPresenterInterface
{
    public function presents(SearchUserResponse $response): void;

    public function getViewModel();
}
