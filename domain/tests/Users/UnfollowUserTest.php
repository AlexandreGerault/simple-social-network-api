<?php

namespace Domain\Tests\Users;

use Domain\SSN\Auth\Entity\User;
use Domain\SSN\Auth\Exceptions\UserNotFoundException;
use Domain\SSN\Auth\Gateway\AuthenticationGateway;
use Domain\SSN\Users\UseCases\UnfollowUser\UnfollowUser;
use Domain\SSN\Users\UseCases\UnfollowUser\UnfollowUserPresenterInterface;
use Domain\SSN\Users\UseCases\UnfollowUser\UnfollowUserRequest;
use Domain\SSN\Users\UseCases\UnfollowUser\UnfollowUserResponse;
use Domain\Tests\Adapters\Repositories\UserRepository;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class UnfollowUserTest extends TestCase
{
    private UnfollowUser $useCase;
    private User $userToUnfollow;
    private UnfollowUserPresenterInterface $presenter;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userToUnfollow = new User(
            Uuid::uuid4(),
            "Unfollow me",
            "unfollow.me@email.tld",
            ""
        );

        $authenticated = new User(
            Uuid::uuid4(),
            "Authenticated",
            "authenticated@email.tld",
            "password",
            [],
            [
                $this->userToUnfollow
            ]
        );

        $gateway = new UserRepository();

        $gateway->registers($this->userToUnfollow);
        $gateway->registers($authenticated);

        $this->useCase = new UnfollowUser($gateway, new class ($authenticated) implements AuthenticationGateway{
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
        $this->presenter = new class implements UnfollowUserPresenterInterface {
            public UnfollowUserResponse $response;

            public function presents(UnfollowUserResponse $response): void
            {
                $this->response = $response;
            }
        };
    }

    public function testUserCanUnfollowAnotherUser()
    {
        // Test initialization
        $request = new UnfollowUserRequest($this->userToUnfollow->getId());

        // Test actions
        $this->useCase->execute($request, $this->presenter);

        // Test assertions
        $this->assertCount(0, $this->presenter->response->getAuthenticated()->getFollowings());
    }

    public function testUserCannotUnfollowNonExistingUser()
    {
        // Test initialization
        $this->expectException(UserNotFoundException::class);
        $request = new UnfollowUserRequest(Uuid::uuid4());

        // Test actions
        $this->useCase->execute($request, $this->presenter);
    }
}
