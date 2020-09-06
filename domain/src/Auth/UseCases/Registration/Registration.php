<?php

namespace Domain\SSN\Auth\UseCases\Registration;

use Assert\AssertionFailedException;
use Domain\SSN\Auth\Entity\User;
use Domain\SSN\Auth\Gateway\UserGateway;

class Registration
{
    private UserGateway $gateway;

    /**
     * Registration constructor.
     * @param UserGateway $gateway
     */
    public function __construct(UserGateway $gateway)
    {
        $this->gateway = $gateway;
    }

    /**
     * @param RegistrationRequest $request
     * @param RegistrationPresenterInterface $presenter
     * @throws AssertionFailedException
     */
    public function execute(RegistrationRequest $request, RegistrationPresenterInterface $presenter)
    {
        $request->validate();

        $user = User::createFromRegistration($request);
        $this->gateway->registers($user);

        $response = new RegistrationResponse($user);
        $presenter->presents($response);
    }
}
