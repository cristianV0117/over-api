<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeTest extends TestCase
{
    /**
     * @return void
     */
    public function test_feature_home_controller(): void
    {
        $appVersion = env("APP_VERSION");

        $response = $this->get('api/' . $appVersion);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            "over" => "OVER API"
        ]);
    }
}
