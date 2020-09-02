<?php

namespace Domain\SSN\Posts\UseCases\CreatePost;

use Assert\AssertionFailedException;
use Domain\SSN\Posts\Entity\Post;
use Domain\SSN\Posts\Gateway\PostGateway;

class CreatePost
{
    private PostGateway $gateway;

    /**
     * CreatePost constructor.
     * @param PostGateway $gateway
     */
    public function __construct(PostGateway $gateway)
    {
        $this->gateway = $gateway;
    }

    /**
     * @param CreatePostRequest $request
     * @param CreatePostPresenterInterface $presenter
     * @throws AssertionFailedException
     */
    public function execute(CreatePostRequest $request, CreatePostPresenterInterface $presenter)
    {
        $request->validate();

        $post = Post::createFromRequest($request);
        $this->gateway->create($post);

        $presenter->presents(new CreatePostResponse($post));
    }
}
