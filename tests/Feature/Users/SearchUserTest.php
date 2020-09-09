<?php

namespace Tests\Feature\Users;

use App\EloquentUser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SearchUserTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $randomUsers = factory(EloquentUser::class, 5)->create();
        $i = 0;
        foreach ($randomUsers as $user) {
            $user->email = "email${i}@email.tld";
            $user->save();
            $i++;
        }
    }

    public function testSearchSuccessful()
    {
        // Test initialization
        factory(EloquentUser::class)->create([
            'username' => 'Jean Paul',
            'email' => 'jean.paul@company.com'
        ]);

        // Test actions
        $response = $this->getJson('/api/users/search?search=jean');

        // Test assertions
        $response->assertStatus(200);
        $response->assertJsonCount(1, "data");
        $response->assertJson([
            "data" => [
                [
                    "attributes" => [
                        "username" => "Jean Paul",
                        "email" => "jean.paul@company.com"
                    ]
                ]
            ]
        ]);
    }
}
