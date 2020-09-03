<?php

namespace Domain\Tests\Posts;

use Assert\AssertionFailedException;
use Domain\SSN\Auth\Entity\User;
use Domain\SSN\Posts\Entity\Post;
use Domain\SSN\Posts\Gateway\PostGateway;
use Domain\SSN\Posts\UseCases\CreatePost\CreatePost;
use Domain\SSN\Posts\UseCases\CreatePost\CreatePostPresenterInterface;
use Domain\SSN\Posts\UseCases\CreatePost\CreatePostRequest;
use Domain\SSN\Posts\UseCases\CreatePost\CreatePostResponse;
use Generator;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class CreatePostTest extends TestCase
{
    private User $user;
    private CreatePost $useCase;
    private CreatePostPresenterInterface $presenter;

    public function setUp(): void
    {
        parent::setUp();

        $gateway = new class implements PostGateway {
            public function create(Post $post): void
            {
            }
        };

        $this->presenter = new class implements CreatePostPresenterInterface {
            public CreatePostResponse $response;

            public function presents(CreatePostResponse $response)
            {
                $this->response = $response;
            }
        };

        $this->user = new User(
            Uuid::uuid4(),
            "AuthorName",
            "author@email.tld",
            "plainPassword"
        );

        $this->useCase = new CreatePost($gateway);
    }

    public function testSuccessful()
    {
        $request = new CreatePostRequest("Some message", $this->user);

        // Test actions
        $this->useCase->execute($request, $this->presenter);

        // Test assertions
        $post = $this->presenter->response->getPost();
        $this->assertInstanceOf(Post::class, $post);
        $this->assertEquals("Some message", $post->getContent());
        $this->assertEquals($this->user, $post->getAuthor());
    }

    /**
     * @dataProvider invalidData
     * @param string|null $postContent
     * @param User|null $user
     * @throws AssertionFailedException
     */
    public function testFailsWithInvalidInput(?string $postContent, ?User $user)
    {
        // Test initialization
        $this->expectException(AssertionFailedException::class);
        $request = new CreatePostRequest($postContent, $user);

        // Test actions
        $this->useCase->execute($request, $this->presenter);
    }

    public function invalidData(): Generator
    {
        yield ["", new User(Uuid::uuid4(), 'name', 'email@email.tld', 'password')];
        yield ["Some Content", null];
    }
}
