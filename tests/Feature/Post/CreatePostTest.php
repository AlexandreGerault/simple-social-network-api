<?php

namespace Tests\Feature\Post;

use App\Models\EloquentPost;
use App\EloquentUser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreatePostTest extends TestCase
{
    use RefreshDatabase;

    private EloquentUser $actor;

    public function setUp(): void
    {
        parent::setUp();

        $this->actor = factory(EloquentUser::class)->create();
    }

    public function testSuccessful()
    {
        // Test initialization
        $this->actingAs($this->actor);
        $postInputs = factory(EloquentPost::class)->raw([
            'user_id' => $this->actor->id
        ]);

        // Test actions
        $response = $this->postJson('/api/posts', $postInputs);

        // Test assertions
        $response->assertStatus(201);
        $this->assertDatabaseHas('posts', [
            'content' => $postInputs['content'],
            'user_id' => $this->actor->id
        ]);
    }

    public function testFailsWithInvalidInputs()
    {
        // Test initialization
        $this->actingAs($this->actor);
        $postInputs = factory(EloquentPost::class)->raw([
            'user_id' => $this->actor->id,
            'content' => ''
        ]);

        // Test actions
        $response = $this->postJson('/api/posts', $postInputs);

        // Test assertions
        $response->assertStatus(422);
    }
}
