<?php

namespace Tests\Feature\Users;

use App\EloquentUser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class FollowUserTest extends TestCase
{
    use RefreshDatabase;

    private EloquentUser $authenticatedUser;

    public function setUp(): void
    {
        parent::setUp();

        $this->authenticatedUser = factory(EloquentUser::class)->create();
    }

    public function testUserCanFollowExistingUser()
    {
        // Test initialization
        $this->actingAs($this->authenticatedUser);
        $userToFollow = factory(EloquentUser::class)->create();

        // Test actions
        $response = $this->postJson('api/users/' . $userToFollow->id . '/follow');

        // Test assertions
        $response->assertStatus(204);
        $this->assertCount(1, $this->authenticatedUser->followings);
    }

    public function testUserCannotFollowNonExistingUser()
    {
        $this->withoutExceptionHandling();
        // Test initialization
        $this->actingAs($this->authenticatedUser);

        // Test actions
        $response = $this->postJson('api/users/' . Uuid::uuid4()->toString() . '/follow');

        // Test assertions
        $response->assertStatus(404);
    }
}
