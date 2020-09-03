<?php

namespace Tests\Feature\Post;

use App\Models\EloquentPost;
use App\EloquentUser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreatePostTest extends TestCase
{
    use RefreshDatabase;

    public function testSuccessful()
    {
        $this->withoutExceptionHandling();
        // Test initialization
        $this->actingAs($user = factory(EloquentUser::class)->create());
        $postInputs = factory(EloquentPost::class)->raw();

        // Test actions
        $response = $this->post('/api/posts', $postInputs);

        // Test assertions
        $response->assertStatus(201);
        $this->assertDatabaseHas('posts', $postInputs);
    }
}
