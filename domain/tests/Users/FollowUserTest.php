<?php

namespace Domain\Tests\Users;

use Domain\SSN\Auth\Entity\User;
use Domain\SSN\Auth\Exceptions\UserNotFoundException;
use Domain\SSN\Auth\Gateway\AuthenticationGateway;
use Domain\SSN\Users\UseCases\FollowUser\FollowUser;
use Domain\SSN\Users\UseCases\FollowUser\FollowUserPresenterInterface;
use Domain\SSN\Users\UseCases\FollowUser\FollowUserRequest;
use Domain\SSN\Users\UseCases\FollowUser\FollowUserResponse;
use Domain\Tests\Adapters\Repositories\UserRepository;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class FollowUserTest extends TestCase
{
    private User $userToFollow;
    private FollowUser $useCase;
    private FollowUserPresenterInterface $presenter;

    public function setUp(): void
    {
        parent::setUp();

        $this->userToFollow = new User(
            Uuid::uuid4(),
            "FollowMe",
            "User2follow@email.tld",
            "password"
        );
        $authenticated = new User(
            Uuid::uuid4(),
            "Authenticated",
            "authenticated@email.tld",
            "password",
            []
        );

        $this->presenter = new class implements FollowUserPresenterInterface{
            public FollowUserResponse $response;

            public function presents(FollowUserResponse $response): void
            {
                $this->response = $response;
            }
        };

        $gateway = new UserRepository();
        $gateway->registers($this->userToFollow);
        $gateway->registers($authenticated);

        $this->useCase = new FollowUser($gateway, new class ($authenticated) implements AuthenticationGateway{
            private User $authenticated;

            /**
             *  constructor.
             * @param User $authenticated
             */
            public function __construct(User $authenticated)
            {
                $this->authenticated = $authenticated;
            }

            public function getAuthenticatedUser(): User
            {
                return $this->authenticated;
            }
        });
    }

    /**
     * @throws UserNotFoundException
     */
    public function testUserCanFollowAnotherUser()
    {
        // Test initialization
        $followRequest = new FollowUserRequest($this->userToFollow->getId());

        // Test actions
        $this->useCase->execute($followRequest, $this->presenter);

        // Test assertions
        $this->assertTrue(in_array($this->userToFollow, $this->presenter->response->getUser()->getFollowings()));
    }

    public function testUserCannotFollowNonExistingUser()
    {
        // Test initialization
        $this->expectException(UserNotFoundException::class);
        $followRequest = new FollowUserRequest(Uuid::uuid4());
        $this->useCase->execute($followRequest, $this->presenter);
    }
}
