<?php

namespace Tests\Feature\Post;

use App\EloquentUser;
use App\Models\EloquentPost;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EditPostTest extends TestCase
{
    use RefreshDatabase;

    private EloquentUser $authUser;
    private EloquentPost $postToEdit;

    public function setUp(): void
    {
        parent::setUp();

        $this->postToEdit = factory(EloquentPost::class)->create();
    }

    public function testSuccessful()
    {
        // Test initialization
        $this->actingAs($this->postToEdit->author);
        $inputs = [
            'content' => 'newcontent'
        ];

        // Test actions
        $response = $this->put("/api/posts/" . $this->postToEdit->id, $inputs, [
            'Accept' => 'application/json'
        ]);

        // Test assertions
        $response->assertStatus(200);
        $this->assertDatabaseHas('posts', $inputs);
    }

    public function testFailsWithInvalidInputs()
    {
        // Test initialization
        $this->actingAs($this->postToEdit->author);
        $inputs = [
            'content' => ''
        ];

        // Test actions
        $response = $this->put("/api/posts/" . $this->postToEdit->id, $inputs, [
            'Accept' => 'application/json'
        ]);

        // Test assertions
        $response->assertStatus(422);
    }
}
