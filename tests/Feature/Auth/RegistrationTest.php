<?php

namespace Tests\Feature\Auth;

use App\User;
use Generator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function testSuccessful()
    {
        // Test initialization
        $inputs = factory(User::class)
            ->raw([
                'password' => password_hash('correctPassword', PASSWORD_ARGON2ID)
            ]);

        // Test actions
        $response = $this->post(
            '/api/register',
            array_merge(
                $inputs,
                ['passwordConfirmation' => $inputs['password']]
            )
        );

        // Test assertions
        $response->assertStatus(201);
        $this->assertDatabaseHas('users', [
            'username' => $inputs['username'],
            'email' => $inputs['email']
        ]);
    }

    /**
     * @dataProvider getInvalidInput
     * @param string $username
     * @param string $email
     * @param string $password
     * @param string $passwordConfirmation
     */
    public function testReturnErrorsListWhenInvalidInputs(
        ?string $username,
        ?string $email,
        ?string $password,
        ?string $passwordConfirmation
    ) {
        // Test initialization
        $inputs = [
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'passwordConfirmation' => $passwordConfirmation
        ];

        // Test actions
        $response = $this->post('/api/register', $inputs, ['Accept' => 'application/json']);

        // Test assertions
        $response->assertStatus(422);
    }

    public function getInvalidInput(): Generator
    {
        yield ["", "good@email.tld", "passwordIdentics", "passwordIdentics"];
        yield ["username", "wrong@email", "passwordIdentics", "passwordIdentics"];
        yield ["username", "", "passwordIdentics", "passwordIdentics"];
        yield ["username", "good@email.tld", "", ""];
        yield ["username", "good@email.tld", "a", ""];
        yield ["username", "good@email.tld", "", "a"];
    }
}
