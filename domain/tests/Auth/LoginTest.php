<?php

namespace Domain\Tests\Auth;

use Domain\SSN\Auth\Entity\User;
use Domain\SSN\Auth\Exceptions\InvalidCredentialsException;
use Domain\SSN\Auth\Exceptions\UserNotFoundException;
use Domain\SSN\Auth\Gateway\UserGateway;
use Domain\SSN\Auth\UseCases\Login\Login;
use Domain\SSN\Auth\UseCases\Login\LoginPresenterInterface;
use Domain\SSN\Auth\UseCases\Login\LoginRequest;
use Domain\SSN\Auth\UseCases\Login\LoginResponse;
use PHPUnit\Framework\TestCase;

class LoginTest extends TestCase
{
    private Login $useCase;
    private LoginPresenterInterface $presenter;
    private UserGateway $userGateway;

    protected function setUp(): void
    {
        parent::setUp();

        $this->presenter = new class () implements LoginPresenterInterface {
            public LoginResponse $response;

            public function presents(LoginResponse $response): void
            {
                $this->response = $response;
            }
        };

        $this->userGateway = new class implements UserGateway {
            /**
             * @param string $email
             * @return User
             */
            public function getUserByEmail(string $email): User
            {
                if ($email == 'good@domain.tld') {
                    return new User($email, password_hash('correctPassword', PASSWORD_ARGON2ID));
                }
                throw new UserNotFoundException();
            }
        };

        $this->useCase = new Login($this->userGateway);
    }

    public function testSuccessful()
    {
        // Test initialization
        $request = new LoginRequest('good@domain.tld', 'correctPassword');

        // Test actions
        $this->useCase->execute($request, $this->presenter);

        // Test assertions
        $user = $this->presenter->response->getUser();
        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('good@domain.tld', $user->getEmail());
        $this->assertTrue(password_verify('correctPassword', $user->getPassword()));
    }

    public function testFailsWithInvalidEmail()
    {
        $this->expectException(UserNotFoundException::class);

        // Test initialization
        $request = new LoginRequest('bad@credentials.tld', 'badPassword');

        // Test actions
        $this->useCase->execute($request, $this->presenter);
    }

    public function testFailsWithInvalidPassword()
    {
        $this->expectException(InvalidCredentialsException::class);

        // Test initialization
        $request = new LoginRequest('good@domain.tld', 'badPassword');

        // Test actions
        $this->useCase->execute($request, $this->presenter);
    }
}
