<?php

namespace Domain\SSN\Auth\UseCases\Login;

use Domain\SSN\Auth\Entity\User;
use Domain\SSN\Auth\Exceptions\InvalidCredentialsException;
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
     * @throws InvalidCredentialsException
     */
    public function execute(LoginRequest $request, LoginPresenterInterface $presenter)
    {
        $user = $this->gateway->getUserByEmail($request->getEmail());
        if (password_verify($request->getPlainPassword(), $user->getPassword())) {
            $response = new LoginResponse($user);
        } else {
            throw new InvalidCredentialsException();
        }

        $presenter->presents($response);
    }
}
