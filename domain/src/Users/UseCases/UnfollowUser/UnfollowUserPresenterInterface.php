<?php

namespace Domain\SSN\Users\UseCases\UnfollowUser;

interface UnfollowUserPresenterInterface
{
    public function presents(UnfollowUserResponse $response): void;
}
