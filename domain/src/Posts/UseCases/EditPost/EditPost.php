<?php

namespace Domain\SSN\Posts\UseCases\EditPost;

use Domain\SSN\Posts\Entity\Post;
use Domain\SSN\Posts\Exceptions\PostNotFoundException;
use Domain\SSN\Posts\Gateway\PostGateway;

class EditPost
{
    private PostGateway $gateway;

    /**
     * EditPost constructor.
     * @param PostGateway $gateway
     */
    public function __construct(PostGateway $gateway)
    {
        $this->gateway = $gateway;
    }

    /**
     * @param EditPostRequest $request
     * @param EditPostPresenterInterface $presenter
     * @throws PostNotFoundException
     */
    public function execute(EditPostRequest $request, EditPostPresenterInterface $presenter)
    {
        $request->validate();
        $postToEdit = $this->gateway->getById($request->getId());
        $editedPost = $this->gateway->update(new Post(
            $postToEdit->getId(),
            $request->getContent(),
            $postToEdit->getAuthor()
        ));

        $response = new EditPostResponse($editedPost);

        $presenter->presents($response);
    }
}
