<?php

namespace Tests\Feature\Post;

use App\EloquentUser;
use App\Models\EloquentPost;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowNewsfeedTest extends TestCase
{
    use RefreshDatabase;

    public function testUserCanShowItsNewsfeed()
    {
        $this->withoutExceptionHandling();
        // Test initialization
        $followings = factory(EloquentUser::class, 2)
            ->create()
            ->each(
                fn($following) => $following->posts()->save(
                    factory(EloquentPost::class)->create()
                )
            );
        $authenticatedUser = factory(EloquentUser::class)->create();
        $authenticatedUser->followings()->attach($followings->pluck('id'));
        $this->actingAs($authenticatedUser);

        // Test actions
        $response = $this->getJson("/api/newsfeed");

        // Test assertions
        $response->assertStatus(200);
        $response->assertJsonCount(2, "data");
        $response->assertJsonStructure();
    }
}
