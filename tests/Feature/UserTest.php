<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_feature_user_index_controller(): void
    {
        $appVersion = env("APP_VERSION");

        $response = $this->withHeaders([
            'Authorization' => env("API_KEY"),
            'Authentication' => env("JWT_KEY_TEST")
        ])->get('api/' . $appVersion . '/users');

        $response->assertStatus(200);
        $response->assertJsonFragment([
            "error" => false
        ]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_feature_user_show_controller(): void
    {
        $appVersion = env("APP_VERSION");

        $response = $this->withHeaders([
            'Authorization' => env("API_KEY"),
            'Authentication' => env("JWT_KEY_TEST")
        ])->get('api/' . $appVersion . '/users/' . rand(1, 5));

        $response->assertStatus(200);
        $response->assertJsonFragment([
            "error" => false
        ]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_feature_user_store_controller(): void
    {
        $appVersion = env("APP_VERSION");

        $response = $this->withHeaders([
            'Authorization' => env("API_KEY"),
            'Authentication' => env("JWT_KEY_TEST")
        ])->post('api/' . $appVersion . '/users', [
            "user_name" => "test",
            "first_name" => "test",
            "second_name" => "test",
            "first_last_name" => "test",
            "second_last_name" => "test",
            "email" => Str::random(10) . "@test.com",
            "cellphone" => "1234567890",
            "password" => "test",
            "state_id" => 2
        ]);

        $response->assertStatus(201);
        $response->assertJsonFragment([
            "error" => false
        ]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_feature_user_destroy_controller(): void
    {
        $appVersion = env("APP_VERSION");

        $response = $this->withHeaders([
            'Authorization' => env("API_KEY"),
            'Authentication' => env("JWT_KEY_TEST")
        ])->delete('api/' . $appVersion . '/users/' . rand(5, 10));

        $response->assertStatus(200);
        $response->assertJsonFragment([
            "error" => false
        ]);
    }
}
