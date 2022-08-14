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
    public function test_feature_user_index_controller()
    {
        $appVersion = env("APP_VERSION");

        $response = $this->get('api/' . $appVersion . '/users');

        $response->assertStatus(200);
        $response->assertJsonFragment([
            "error" => false
        ]);
    }
}
