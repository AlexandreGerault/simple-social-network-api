<?php

namespace Domain\SSN\Users\UseCases\FollowUser;

use Domain\SSN\Auth\Exceptions\UserNotFoundException;
use Domain\SSN\Auth\Gateway\AuthenticationGateway;
use Domain\SSN\Auth\Gateway\UserGateway;

class FollowUser
{
    private UserGateway $usersGateway;
    private AuthenticationGateway $authGateway;

    /**
     * FollowUser constructor.
     * @param UserGateway $usersGateway
     * @param AuthenticationGateway $authenticationGateway
     */
    public function __construct(UserGateway $usersGateway, AuthenticationGateway $authenticationGateway)
    {
        $this->usersGateway = $usersGateway;
        $this->authGateway = $authenticationGateway;
    }

    /**
     * @param FollowUserRequest $request
     * @param FollowUserPresenterInterface $presenter
     * @throws UserNotFoundException
     */
    public function execute(FollowUserRequest $request, FollowUserPresenterInterface $presenter)
    {
        $userToFollow = $this->usersGateway->getUserById($request->getId());
        $authUser = $this->authGateway->getAuthenticatedUser();

        $authUser = $this->usersGateway->makeUserFollow($authUser, $userToFollow);

        $presenter->presents(new FollowUserResponse($authUser));
    }
}
