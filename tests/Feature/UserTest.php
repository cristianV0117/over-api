<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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

        $response = $this->get('api/' . $appVersion . '/users',  [
            'Authorization' => env("API_KEY")
        ]);

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

        $response = $this->get('api/' . $appVersion . '/users/' . rand(1, 5), [
            'Authorization' => env("API_KEY")
        ]);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            "error" => false
        ]);
    }
}
