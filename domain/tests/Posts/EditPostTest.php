<?php

namespace Domain\Tests\Posts;

use Assert\AssertionFailedException;
use Domain\SSN\Auth\Entity\User;
use Domain\SSN\Posts\Entity\Post;
use Domain\SSN\Posts\UseCases\EditPost\EditPost;
use Domain\SSN\Posts\UseCases\EditPost\EditPostPresenterInterface;
use Domain\SSN\Posts\UseCases\EditPost\EditPostRequest;
use Domain\SSN\Posts\UseCases\EditPost\EditPostResponse;
use Domain\SSN\Posts\ViewModels\PostViewModelInterface;
use Domain\Tests\Adapters\Repositories\PostRepository;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class EditPostTest extends TestCase
{
    private Post $postToEdit;
    private EditPost $useCase;
    private EditPostPresenterInterface $presenter;

    public function setUp(): void
    {
        parent::setUp();

        $gateway = new PostRepository();

        $this->presenter = new class implements EditPostPresenterInterface {
            public EditPostResponse $response;

            public function presents(EditPostResponse $response): void
            {
                $this->response = $response;
            }

            public function getViewModel(): PostViewModelInterface
            {
            }
        };

        $user = new User(
            Uuid::uuid4(),
            "AuthorName",
            "author@email.tld",
            "plainPassword"
        );

        $this->postToEdit = new Post(
            Uuid::uuid4(),
            "Content",
            $user
        );

        $this->useCase = new EditPost($gateway);
    }

    public function testSuccessful()
    {
        // Test initialization
        $request = new EditPostRequest(
            $this->postToEdit->getId(),
            "New content"
        );

        // Test actions
        $this->useCase->execute($request, $this->presenter);

        // Test assertions
        $editedPost = $this->presenter->response->getPost();
        $this->assertEquals("New content", $editedPost->getContent());
    }

    public function testFailsWithEmptyContent()
    {
        // Test initialization
        $this->expectException(AssertionFailedException::class);
        $request = new EditPostRequest($this->postToEdit->getId(), "");

        // Test actions
        $this->useCase->execute($request, $this->presenter);
    }
}
