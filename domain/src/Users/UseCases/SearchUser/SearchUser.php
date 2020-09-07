<?php

namespace Domain\SSN\Users\UseCases\SearchUser;

use Assert\AssertionFailedException;
use Domain\SSN\Auth\Gateway\UserGateway;

class SearchUser
{
    private UserGateway $gateway;

    /**
     * SearchUser constructor.
     * @param UserGateway $gateway
     */
    public function __construct(UserGateway $gateway)
    {
        $this->gateway = $gateway;
    }

    /**
     * @param SearchUserRequest $request
     * @param SearchUserPresenterInterface $presenter
     * @throws AssertionFailedException
     */
    public function execute(SearchUserRequest $request, SearchUserPresenterInterface $presenter)
    {
        $request->validate();
        $results = $this->gateway->search($request->getSearch());
        $response = new SearchUserResponse($results);

        $presenter->presents($response);
    }
}
