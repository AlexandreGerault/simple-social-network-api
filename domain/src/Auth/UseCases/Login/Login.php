<?php

namespace Domain\SSN\Auth\UseCases\Login;

use Domain\SSN\Auth\Exceptions\InvalidCredentialsException;
use Domain\SSN\Auth\Exceptions\UserNotFoundException;
use Domain\SSN\Auth\Gateway\UserGateway;

class Login
{
    /**
     * @var UserGateway
     */
    private UserGateway $gateway;

    /**
     * Login constructor.
     * @param UserGateway $gateway
     */
    public function __construct(UserGateway $gateway)
    {
        $this->gateway = $gateway;
    }

    /**
     * @param LoginRequest $request
     * @param LoginPresenterInterface $presenter
     * @throws InvalidCredentialsException|UserNotFoundException
     */
    public function execute(LoginRequest $request, LoginPresenterInterface $presenter)
    {
        $user = $this->gateway->getUserByEmail($request->getEmail());

        if (password_verify($request->getPlainPassword(), $user->getPassword())) {
            $response = new LoginResponse($user);
            $presenter->presents($response);
        } else {
            throw new InvalidCredentialsException();
        }
    }
}
