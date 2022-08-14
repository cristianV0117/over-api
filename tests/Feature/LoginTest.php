<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_feature_login_user_controller(): void
    {
        $appVersion = env("APP_VERSION");

        $response = $this->get('api/' . $appVersion . '/login', [
            'Authorization' => env("API_KEY")
        ]);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            "error" => false
        ]);
    }
}
