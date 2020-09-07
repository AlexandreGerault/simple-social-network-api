<?php

namespace Tests\Feature\Auth;

use App\EloquentUser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EditProfileTest extends TestCase
{
    use RefreshDatabase;

    private EloquentUser $userToUpdateProfile;

    public function setUp(): void
    {
        parent::setUp();

        $this->userToUpdateProfile = factory(EloquentUser::class)->create();
    }

    public function testUpdateFullProfileSuccessfully()
    {
        // Test initialization
        $this->actingAs($this->userToUpdateProfile);
        $inputs = [
            'username' => 'My new username',
            'email' => 'my-new@email.tld'
        ];

        // Test actions
        $response = $this->patchJson("/api/users/{$this->userToUpdateProfile->id}", $inputs);

        // Test assertions
        $response->assertStatus(200);
        $this->assertDatabaseHas('users', $inputs);
    }

    public function testUpdateOnlyEmailSuccessfully()
    {
        // Test initialization
        $this->actingAs($this->userToUpdateProfile);
        $inputs = [
            'email' => 'my-new@email.tld'
        ];

        // Test actions
        $response = $this->patchJson("/api/users/{$this->userToUpdateProfile->id}", $inputs);

        // Test assertions
        $response->assertStatus(200);
        $this->assertDatabaseHas('users', $inputs);
    }

    public function testUpdateOnlyUsernameSuccessfully()
    {
        // Test initialization
        $this->actingAs($this->userToUpdateProfile);
        $inputs = [
            'username' => 'My new username'
        ];

        // Test actions
        $response = $this->patchJson("/api/users/{$this->userToUpdateProfile->id}", $inputs);

        // Test assertions
        $response->assertStatus(200);
        $this->assertDatabaseHas('users', $inputs);
    }

    public function testFailsUpdateWithWrongEmail()
    {
        // Test initialization
        $this->actingAs($this->userToUpdateProfile);
        $inputs = [
            'email' => 'my-newemail.tld'
        ];

        // Test actions
        $response = $this->patchJson("/api/users/{$this->userToUpdateProfile->id}", $inputs);

        // Test assertions
        $response->assertStatus(422);
    }

    /**
     * @dataProvider provideDataAlreadyInUse
     * @param string|null $username
     * @param string|null $email
     */
    public function testFailsWhenUsingUsernameOrEmailAlreadyInUse(?string $username, ?string $email)
    {
        // Test initialization
        factory(EloquentUser::class)->create([
            'username' => $username ?? 'random',
            'email' => $email ?? 'available@email.tld'
        ]);
        $this->actingAs($this->userToUpdateProfile);
        $inputs = [
            'email' => 'my-newemail.tld'
        ];

        // Test actions
        $response = $this->patchJson("/api/users/{$this->userToUpdateProfile->id}", $inputs);

        // Test assertions
        $response->assertStatus(422);
    }

    public function provideDataAlreadyInUse()
    {
        yield ["used", ""];
        yield ["", "used@email.tld"];
        yield ["used", "used@email.tld"];
    }
}
