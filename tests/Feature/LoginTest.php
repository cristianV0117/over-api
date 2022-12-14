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

        $response = $this->withHeaders([
            'Authorization' => env("API_KEY")
        ])->post('api/' . $appVersion . '/login', [
            'user_name' => "manual",
            'email' => "Dach@manual.com",
            'password' => 'manual'
        ]);

        dump($response->getContent());

        $response->assertStatus(200);
        $response->assertJsonFragment([
            "error" => false
        ]);
    }
}
