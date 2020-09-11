<?php

namespace Domain\SSN\Users\UseCases\ShowUser;

use Domain\SSN\Auth\Exceptions\UserNotFoundException;
use Domain\SSN\Auth\Gateway\UserGateway;

class ShowUser
{
    private UserGateway $gateway;

    /**
     * ShowUser constructor.
     * @param UserGateway $gateway
     */
    public function __construct(UserGateway $gateway)
    {
        $this->gateway = $gateway;
    }

    /**
     * @param ShowUserRequest $request
     * @param ShowUserPresenterInterface $presenter
     * @throws UserNotFoundException
     */
    public function execute(ShowUserRequest $request, ShowUserPresenterInterface $presenter)
    {
        $userToShow = $this->gateway->getUserByIdAndWithPosts($request->getId());
        $response = new ShowUserResponse($userToShow);
        $presenter->presents($response);
    }
}
