<?php

namespace Tests\Feature\Users;

use App\EloquentUser;
use App\Models\EloquentPost;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowUserTest extends TestCase
{
    use RefreshDatabase;

    public function testShowProfilePageSuccessfully()
    {
        $this->withoutExceptionHandling();
        // Test initialization
        $userToShow = factory(EloquentUser::class)
            ->create();
        $userToShow->posts()->save(factory(EloquentPost::class)->create());
        $userToShow->posts()->save(factory(EloquentPost::class)->create());
        $userToShow->posts()->save(factory(EloquentPost::class)->create());

        // Test actions
        $response = $this->getJson("/api/users/" . $userToShow->id);

        // Test assertions
        $response->assertStatus(200);
        $response->assertJsonCount(3, 'data.relationships.posts');
        $response->assertJson([
            "data" => [
                "attributes" => [
                    "username" => $userToShow->username,
                    "email" => $userToShow->email,
                    ]
            ]
        ]);
    }
}
