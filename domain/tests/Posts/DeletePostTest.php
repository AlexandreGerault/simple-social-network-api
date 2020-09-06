<?php

namespace Domain\Tests\Posts;

use Domain\SSN\Auth\Entity\User;
use Domain\SSN\Posts\Entity\Post;
use Domain\SSN\Posts\Exceptions\PostNotFoundException;
use Domain\SSN\Posts\Gateway\PostGateway;
use Domain\SSN\Posts\UseCases\DeletePost\DeletePost;
use Domain\SSN\Posts\UseCases\DeletePost\DeletePostPresenterInterface;
use Domain\SSN\Posts\UseCases\DeletePost\DeletePostRequest;
use Domain\SSN\Posts\UseCases\DeletePost\DeletePostResponse;
use Domain\Tests\Adapters\Repositories\PostRepository;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Exception\InvalidUuidStringException;
use Ramsey\Uuid\Uuid;

class DeletePostTest extends TestCase
{
    private PostGateway $gateway;
    private DeletePost $useCase;
    private DeletePostPresenterInterface $presenter;

    public function setUp(): void
    {
        parent::setUp();
        $this->gateway = new PostRepository();
        $this->presenter = new class implements DeletePostPresenterInterface {
            public DeletePostResponse $response;

            public function presents(DeletePostResponse $response): void
            {
                $this->response = $response;
            }
        };
        $this->useCase = new DeletePost($this->gateway);
    }

    public function testDeleteSuccessful()
    {
        // Test initialization
        $postToDelete = new Post(
            Uuid::uuid4(),
            "Content",
            new User(
                Uuid::uuid4(),
                "Author",
                "author@email.fr",
                "password"
            )
        );
        $deletePostRequest = new DeletePostRequest($postToDelete->getId());

        // Test actions
        $this->useCase->execute($deletePostRequest, $this->presenter);

        // Test assertions
        $this->assertEquals("Post deleted", $this->presenter->response->getMessage());
    }

    public function testDeleteImpossibleWithWrongId()
    {
        $this->expectException(PostNotFoundException::class);

        // Test initialization
        $deletePostRequest = new DeletePostRequest(Uuid::fromString("df81359a-444d-438f-b429-24e0db62178d"));

        // Test actions
        $this->useCase->execute($deletePostRequest, $this->presenter);
    }

    public function testFailsWithInvalidUuid()
    {
        $this->expectException(InvalidUuidStringException::class);

        // Test initialization
        $deletePostRequest = new DeletePostRequest(Uuid::fromString("df81359a-444d-438f-b429-24e0178d"));

        // Test actions
        $this->useCase->execute($deletePostRequest, $this->presenter);
    }
}
