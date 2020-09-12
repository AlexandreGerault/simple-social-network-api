<?php

namespace Domain\SSN\Users\UseCases\FollowUser;

interface FollowUserPresenterInterface
{
    public function presents(FollowUserResponse $response): void;
}
