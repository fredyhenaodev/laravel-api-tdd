<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class UserController
 *
 * Run test for this file
 * php artisan test tests/Feature/StoreUserTest
 * php artisan test --filter StoreUserTest
 *
 * @package Tests\Feature
 */
class StoreUserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Constants for the names
     */
    const FIELD_NAME      = 'name'; 
    const FIELD_LAST_NAME = 'last_name'; 
    const FIELD_EMAIL     = 'email'; 
    const FIELD_PHONE     = 'phone';
    
    /**
     * Constants with values
     */
    const VALUE_NAME      = 'spartan'; 
    const VALUE_LAST_NAME = 'sproutloud'; 
    const VALUE_EMAIL     = 'spartan@sproutloud.com'; 
    const VALUE_PHONE     = 3333333;

    /**
     * @test
     */
    public function user_can_be_created()
    {
        // Arrange
        $user = [
            self::FIELD_NAME      => self::VALUE_NAME,
            self::FIELD_LAST_NAME => self::VALUE_LAST_NAME,
            self::FIELD_EMAIL     => self::VALUE_EMAIL,
            self::FIELD_PHONE     => self::VALUE_PHONE
        ];

        // Act
        $response = $this->json('POST', '/api/v1/users', $user);

        // Assert 
        $response->assertStatus(201);

        $user_model = User::first();

        $this->assertEquals($user['name'], $user_model->name);
        $this->assertEquals($user['last_name'], $user_model->last_name);
        $this->assertEquals($user['email'], $user_model->email);
        $this->assertEquals($user['phone'], $user_model->phone);
    }

    /**
     * @test
     */
    public function user_cannot_be_created_without_a_name()
    {
        $user = [
            self::FIELD_LAST_NAME => self::VALUE_LAST_NAME,
            self::FIELD_EMAIL     => self::VALUE_EMAIL,
            self::FIELD_PHONE     => self::VALUE_PHONE
        ];

        $response = $this->json('POST', '/api/v1/users', $user);

        $response
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'name' => ['The name field is required.']
                ]
            ]);

    }

    /**
     * @test
     */
    public function user_cannot_be_created_if_the_name_value_is_not_a_string()
    {
        $user = [
            self::FIELD_NAME      => 123456789,
            self::FIELD_LAST_NAME => self::VALUE_LAST_NAME,
            self::FIELD_EMAIL     => self::VALUE_EMAIL,
            self::FIELD_PHONE     => self::VALUE_PHONE
        ];

        $response = $this->json('POST', '/api/v1/users', $user);

        $response
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'name' => ['The name must be a string.']
                ]
            ]);

    }

}
