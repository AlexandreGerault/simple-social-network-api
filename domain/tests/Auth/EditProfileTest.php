<?php

namespace Domain\Tests\Auth;

use Assert\AssertionFailedException;
use Domain\SSN\Auth\Entity\User;
use Domain\SSN\Auth\UseCases\EditProfile\EditProfile;
use Domain\SSN\Auth\UseCases\EditProfile\EditProfilePresenterInterface;
use Domain\SSN\Auth\UseCases\EditProfile\EditProfileRequest;
use Domain\SSN\Auth\UseCases\EditProfile\EditProfileResponse;
use Domain\Tests\Adapters\Repositories\UserRepository;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class EditProfileTest extends TestCase
{
    private User $user;
    private EditProfile $useCase;
    private EditProfilePresenterInterface $presenter;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = new User(
            Uuid::uuid4(),
            "User's name",
            "user@email.tld",
            "correctPassword"
        );

        $this->presenter = new class implements EditProfilePresenterInterface {
            public EditProfileResponse $response;

            public function presents(EditProfileResponse $response): void
            {
                $this->response = $response;
            }
        };

        $gateway = new UserRepository();
        $gateway->registers($this->user);

        $this->useCase = new EditProfile($gateway);
    }

    public function testSuccessful()
    {
        // Test initialization
        $updateRequest = new EditProfileRequest(
            $this->user->getId(),
            "New username",
            "new@email.com"
        );

        // Test actions
        $this->useCase->execute($updateRequest, $this->presenter);

        // Test assertions
        $this->assertEquals($updateRequest->getUsername(), $this->presenter->response->getUser()->getUsername());
        $this->assertEquals($updateRequest->getEmail(), $this->presenter->response->getUser()->getEmail());
    }

    public function testSuccessfulWhenUpdateOnlyUsername()
    {
        // Test initialization
        $updateRequest = new EditProfileRequest(
            $this->user->getId(),
            "New username",
            null
        );

        // Test actions
        $this->useCase->execute($updateRequest, $this->presenter);

        // Test assertions
        $this->assertEquals($updateRequest->getUsername(), $this->presenter->response->getUser()->getUsername());
        $this->assertEquals($this->user->getEmail(), $this->presenter->response->getUser()->getEmail());
    }

    public function testSuccessfulWhenUpdateOnlyEmail()
    {
        // Test initialization
        $updateRequest = new EditProfileRequest(
            $this->user->getId(),
            null,
            "new@email.com"
        );

        // Test actions
        $this->useCase->execute($updateRequest, $this->presenter);

        // Test assertions
        $this->assertEquals($this->user->getUsername(), $this->presenter->response->getUser()->getUsername());
        $this->assertEquals($updateRequest->getEmail(), $this->presenter->response->getUser()->getEmail());
    }

    public function testFailsWithInvalidInputs()
    {
        $this->expectException(AssertionFailedException::class);

        // Test initialization
        $updateRequest = new EditProfileRequest(
            $this->user->getId(),
            null,
            "newemail"
        );

        // Test actions
        $this->useCase->execute($updateRequest, $this->presenter);
    }
}
