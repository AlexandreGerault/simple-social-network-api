<?php

namespace Tests\Feature\Auth;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create([
            'email' => 'good@domain.tld',
            'password' => password_hash('correctPassword', PASSWORD_ARGON2ID)
        ]);
    }

    public function testSuccessful()
    {
        $this->withoutExceptionHandling();
        // Test initialization
        $credentials = [
            'email' => 'good@domain.tld',
            'password' => 'correctPassword'
        ];

        // Test actions
        $response = $this->post('/api/login', $credentials);

        // Test assertions
        $response->assertStatus(200);
        $this->assertAuthenticated();
    }

    public function testFails()
    {
        // Test initialization
        $credentials = [
            'email' => 'bad@domain.tld',
            'password' => 'correctPassword'
        ];

        // Test actions
        $response = $this->post('/api/login', $credentials);

        // Test assertions
        $response->assertStatus(404);
        $this->assertGuest();
    }

    public function testLoginAsAuthenticated()
    {
        // Test initialization
        $this->actingAs($this->user);
        $credentials = [
            'email' => 'bad@domain.tld',
            'password' => 'correctPassword'
        ];

        // Test actions
        $response = $this->post('/api/login', $credentials);

        $response->assertRedirect();
    }

    public function testAuthenticatedCanLogout()
    {
        $this->withoutExceptionHandling();
        // Test initialization
        $this->actingAs($this->user);

        // Test actions
        $response = $this->get('/api/logout');

        // Test assertions
        $response->assertStatus(204);
    }
}
