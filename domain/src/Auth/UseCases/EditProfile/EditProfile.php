<?php

namespace Domain\SSN\Auth\UseCases\EditProfile;

use Domain\SSN\Auth\Entity\User;
use Domain\SSN\Auth\Gateway\UserGateway;

class EditProfile
{
    private UserGateway $gateway;

    /**
     * EditProfile constructor.
     * @param UserGateway $gateway
     */
    public function __construct(UserGateway $gateway)
    {
        $this->gateway = $gateway;
    }

    public function execute(EditProfileRequest $request, EditProfilePresenterInterface $presenter)
    {
        $request->validate();
        $userToEdit = $this->gateway->getUserById($request->getId());

        $newUser = $this->gateway->update(new User(
            $request->getId(),
            $request->getUsername() ?? $userToEdit->getUsername(),
            $request->getEmail() ?? $userToEdit->getEmail(),
            $userToEdit->getPassword()
        ));

        $presenter->presents(new EditProfileResponse($newUser));
    }
}
