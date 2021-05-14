<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class UserController
 *
 * Run test for this file
 * php artisan test tests/Feature/ShowUserTest
 * php artisan test --filter ShowUserTest
 *
 * @package Tests\Feature
 */
class ShowUserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function user_can_be_view_his_data()
    {
        $user = User::factory()->create();

        $response = $this->json('GET', '/api/v1/users/' . $user->id);

        $response
            ->assertStatus(200)
            ->assertJson(
                [
                    'data' => [
                        'name' => $user->name,
                        'last_name' => $user->last_name
                    ]
                ]
            );
    }

    /**
     * @test
     */
    public function user_can_not_view_his_data_because_does_not_exist()
    {
        $response = $this->json('GET', '/api/v1/users/5');

        $response->assertNotFound();
    }
}
