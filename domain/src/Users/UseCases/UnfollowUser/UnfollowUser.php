<?php

namespace Domain\SSN\Users\UseCases\UnfollowUser;

use Domain\SSN\Auth\Exceptions\UserNotFoundException;
use Domain\SSN\Auth\Gateway\AuthenticationGateway;
use Domain\SSN\Auth\Gateway\UserGateway;

class UnfollowUser
{
    private UserGateway $gateway;
    private AuthenticationGateway $authenticationGateway;

    /**
     * UnfollowUser constructor.
     * @param UserGateway $gateway
     * @param AuthenticationGateway $authenticationGateway
     */
    public function __construct(UserGateway $gateway, AuthenticationGateway $authenticationGateway)
    {
        $this->gateway = $gateway;
        $this->authenticationGateway = $authenticationGateway;
    }

    /**
     * @param UnfollowUserRequest $request
     * @param UnfollowUserPresenterInterface $presenter
     * @throws UserNotFoundException
     */
    public function execute(UnfollowUserRequest $request, UnfollowUserPresenterInterface $presenter)
    {
        $userToUnfollow = $this->gateway->getUserById($request->getId());
        $authUser = $this->gateway->makeUserUnfollow(
            $this->authenticationGateway->getAuthenticatedUser(),
            $userToUnfollow
        );
        $presenter->presents(new UnfollowUserResponse($authUser));
    }
}
