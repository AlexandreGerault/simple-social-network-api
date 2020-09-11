<?php

namespace Domain\Tests\Users;

use Domain\SSN\Auth\Entity\User;
use Domain\SSN\Auth\Exceptions\UserNotFoundException;
use Domain\SSN\Posts\Entity\Post;
use Domain\SSN\Users\UseCases\ShowUser\ShowUser;
use Domain\SSN\Users\UseCases\ShowUser\ShowUserPresenterInterface;
use Domain\SSN\Users\UseCases\ShowUser\ShowUserRequest;
use Domain\SSN\Users\UseCases\ShowUser\ShowUserResponse;
use Domain\SSN\Users\ViewModels\UserWithPostsViewModelInterface;
use Domain\Tests\Adapters\Repositories\UserRepository;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class ShowUserTest extends TestCase
{
    private User $userToShowProfile;
    private ShowUser $useCase;
    private ShowUserPresenterInterface $presenter;

    public function setUp(): void
    {
        parent::setUp();

        $this->userToShowProfile = new User(
            Uuid::uuid4(),
            "Username",
            "mail@mail.tld",
            "password"
        );

        $gateway = new UserRepository();
        $gateway->registers($this->userToShowProfile);
        $this->userToShowProfile->addPosts([
            new Post(Uuid::uuid4(), 'First post', $this->userToShowProfile),
            new Post(Uuid::uuid4(), 'Second post', $this->userToShowProfile),
            new Post(Uuid::uuid4(), 'Third post', $this->userToShowProfile),
        ]);
        $gateway->update($this->userToShowProfile);

        $this->presenter = new class implements ShowUserPresenterInterface {
            public ShowUserResponse $response;

            public function presents(ShowUserResponse $response): void
            {
                $this->response = $response;
            }

            public function getViewModel(): UserWithPostsViewModelInterface
            {
            }
        };


        $this->useCase = new ShowUser($gateway);
    }

    /**
     * We intend to get the user asked by the request with its posts.
     *
     * @throws UserNotFoundException
     */
    public function testShowUserPage()
    {
        // Test initialization
        $request = new ShowUserRequest($this->userToShowProfile->getId());

        // Test actions
        $this->useCase->execute($request, $this->presenter);

        // Test assertions
        $this->assertSame(
            $this->userToShowProfile->getUsername(),
            $this->presenter->response->getUser()->getUsername()
        );
        $this->assertCount(3, $this->presenter->response->getUser()->getPosts());
    }

    public function testShowUserThatDoesntExistThrowUserNotFoundException()
    {
        $this->expectException(UserNotFoundException::class);
        // Test initialization
        $request = new ShowUserRequest(Uuid::uuid4());

        // Test actions
        $this->useCase->execute($request, $this->presenter);
    }
}
