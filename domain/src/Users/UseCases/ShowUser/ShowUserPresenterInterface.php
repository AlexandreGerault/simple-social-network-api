<?php

namespace Domain\SSN\Users\UseCases\ShowUser;

interface ShowUserPresenterInterface
{
    public function presents(ShowUserResponse $response): void;
}
