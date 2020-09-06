<?php

namespace Domain\Tests\Auth;

use Assert\AssertionFailedException;
use Domain\SSN\Auth\Entity\User;
use Domain\SSN\Auth\Gateway\UserGateway;
use Domain\SSN\Auth\UseCases\Registration\Registration;
use Domain\SSN\Auth\UseCases\Registration\RegistrationPresenterInterface;
use Domain\SSN\Auth\UseCases\Registration\RegistrationRequest;
use Domain\SSN\Auth\UseCases\Registration\RegistrationResponse;
use Domain\SSN\Auth\ViewModels\UserViewModelInterface;
use Domain\Tests\Adapters\Repositories\UserRepository;
use Generator;
use PHPUnit\Framework\TestCase;

class RegistrationTest extends TestCase
{
    private Registration $useCase;
    private RegistrationPresenterInterface $presenter;
    private UserGateway $gateway;

    public function setUp(): void
    {
        parent::setUp();

        $this->gateway = new UserRepository();
        $this->useCase = new Registration($this->gateway);
        $this->presenter = new class implements RegistrationPresenterInterface {
            public RegistrationResponse $response;

            public function presents(RegistrationResponse $response): void
            {
                $this->response = $response;
            }

            public function getViewModel(): UserViewModelInterface
            {
            }
        };
    }

    public function testSuccessful()
    {
        // Test initialization
        $registrationRequest = new RegistrationRequest(
            'User name',
            'email@domain.tld',
            'correctPassword',
            'correctPassword'
        );

        // Test actions
        $this->useCase->execute($registrationRequest, $this->presenter);

        // Test assertions
        $user = $this->presenter->response->getUser();
        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($user->getUsername(), $this->gateway->getUserByEmail("email@domain.tld")->getUsername());
        $this->assertEquals($user->getEmail(), $this->gateway->getUserByEmail("email@domain.tld")->getEmail());
    }

    /**
     * @dataProvider getInvalidInput
     * @param string $username
     * @param string $email
     * @param string $plainPassword
     * @param string $plainPasswordConfirmation
     */
    public function testFailsWithInvalidInputs(
        string $username,
        string $email,
        string $plainPassword,
        string $plainPasswordConfirmation
    ) {
        // Test initialization
        $request = new RegistrationRequest($username, $email, $plainPassword, $plainPasswordConfirmation);
        $this->expectException(AssertionFailedException::class);

        // Test actions
        $this->useCase->execute($request, $this->presenter);
    }

    public function getInvalidInput(): Generator
    {
        yield ["", "email@domain.tld", "password", "password"];
        yield ["username", "", "password", "password"];
        yield ["username", "email@domain", "password", "password"];
        yield ["username", "email@domain.tld", "password", "a"];
        yield ["username", "email@domain.tld", "", "a"];
    }
}
