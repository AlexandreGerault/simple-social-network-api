<?php

namespace Domain\SSN\Posts\UseCases\ShowNewsfeed;

use Domain\SSN\Auth\Gateway\AuthenticationGateway;
use Domain\SSN\Posts\Gateway\PostGateway;

class ShowNewsfeed
{
    private AuthenticationGateway $authenticationGateway;
    private PostGateway $postGateway;

    /**
     * ShowNewsfeed constructor.
     * @param AuthenticationGateway $authenticationGateway
     * @param PostGateway $postGateway
     */
    public function __construct(AuthenticationGateway $authenticationGateway, PostGateway $postGateway)
    {
        $this->authenticationGateway = $authenticationGateway;
        $this->postGateway = $postGateway;
    }

    public function execute(ShowNewsfeedPresenterInterface $presenter)
    {
        $authenticatedUser = $this->authenticationGateway->getAuthenticatedUser();
        $posts = $this->postGateway->getNewsfeed($authenticatedUser);
        $presenter->presents(new ShowNewsfeedResponse($posts));
    }
}
