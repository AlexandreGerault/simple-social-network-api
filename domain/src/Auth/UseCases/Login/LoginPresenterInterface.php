<?php


namespace Domain\SSN\Auth\UseCases\Login;


interface LoginPresenterInterface
{
    public function presents(LoginResponse $response): void;
}
