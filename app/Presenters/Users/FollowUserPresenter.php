<?php

namespace App\Presenters\Users;

use Domain\SSN\Users\UseCases\FollowUser\FollowUserPresenterInterface;
use Domain\SSN\Users\UseCases\FollowUser\FollowUserResponse;

class FollowUserPresenter implements FollowUserPresenterInterface
{
    public function presents(FollowUserResponse $response): void
    {
    }
}
