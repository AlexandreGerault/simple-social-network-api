<?php

namespace Domain\Tests\Posts;

use Domain\SSN\Auth\Entity\User;
use Domain\SSN\Posts\Entity\Post;
use Domain\SSN\Posts\UseCases\ShowNewsfeed\ShowNewsfeed;
use Domain\SSN\Posts\UseCases\ShowNewsfeed\ShowNewsfeedPresenterInterface;
use Domain\SSN\Posts\UseCases\ShowNewsfeed\ShowNewsfeedRequest;
use Domain\SSN\Posts\UseCases\ShowNewsfeed\ShowNewsfeedResponse;
use Domain\SSN\Posts\ViewModels\PostCollectionViewModelInterface;
use Domain\Tests\Adapters\Repositories\AuthenticatedUserProvider;
use Domain\Tests\Adapters\Repositories\PostRepository;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class ShowNewsfeedTest extends TestCase
{
    private ShowNewsfeed $useCase;
    private ShowNewsfeedPresenterInterface $presenter;

    public function setUp(): void
    {
        parent::setUp();

        /**
         * @var array<User> $followings
         */
        $followings = [
            new User(
                Uuid::uuid4(),
                "following1",
                "following1@email.tld",
                "password"
            ),
            new User(
                Uuid::uuid4(),
                "following2",
                "following2@email.tld",
                "password"
            )
        ];

        // On ajoute un post à chaque utilisateur suivi
        $followingsWithPosts = array_map(fn ($user) => $user->addPost(new Post(
            Uuid::uuid4(),
            "Some random content by" . $user->getUsername(),
            $user
        )), $followings);

        $authenticated = new User(
            Uuid::uuid4(),
            "authenticated",
            "authenticated@email.tld",
            "password",
            [],
            $followingsWithPosts
        );

        $this->presenter = new class implements ShowNewsfeedPresenterInterface{
            public ShowNewsfeedResponse $response;

            public function presents(ShowNewsfeedResponse $response): void
            {
                $this->response = $response;
            }

            public function getViewModel(): PostCollectionViewModelInterface
            {
            }
        };

        $this->useCase = new ShowNewsfeed(
            new AuthenticatedUserProvider($authenticated),
            new PostRepository()
        );
    }

    public function testUserCanShowItsNewsfeed()
    {
        // Test initialization
        $request = new ShowNewsfeedRequest();

        // Test actions
        $this->useCase->execute($request, $this->presenter);

        // Test assertions
        $posts = $this->presenter->response->getPosts();
        $this->assertCount(2, $this->presenter->response->getPosts());
        $this->assertContainsOnlyInstancesOf(Post::class, $posts);
    }
}
