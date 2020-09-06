<?php

namespace Tests\Feature\Post;

use App\EloquentUser;
use App\Models\EloquentPost;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeletePostTest extends TestCase
{
    use RefreshDatabase;

    public function testDeleteSuccessfully()
    {
        // Test initialization
        $postToDelete = factory(EloquentPost::class)->create();
        $this->actingAs($postToDelete->author);

        // Test actions
        $response = $this->deleteJson("/api/posts/{$postToDelete->id}");

        // Test assertions
        $response->assertStatus(204);
        $this->assertDatabaseMissing('posts', [
            'id' => $postToDelete->id
        ]);
    }

    public function testDeleteNonExistingPost()
    {
        // Test initialization
        $this->actingAs(factory(EloquentUser::class)->create());

        // Test actions
        $reponse = $this->deleteJson("/api/posts/df81359a-444d-438f-b429-24e0db62178d");

        // Test assertions
        $reponse->assertStatus(404);
    }
}
