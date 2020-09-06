<?php

namespace Domain\SSN\Posts\UseCases\DeletePost;

use Domain\SSN\Posts\Exceptions\PostNotFoundException;
use Domain\SSN\Posts\Gateway\PostGateway;

class DeletePost
{
    private PostGateway $gateway;

    public function __construct(PostGateway $gateway)
    {
        $this->gateway = $gateway;
    }

    /**
     * @param DeletePostRequest $request
     * @param DeletePostPresenterInterface $presenter
     * @throws PostNotFoundException
     */
    public function execute(DeletePostRequest $request, DeletePostPresenterInterface $presenter)
    {
        $this->gateway->delete($request->getId());
        $presenter->presents(new DeletePostResponse("Post deleted"));
    }
}
