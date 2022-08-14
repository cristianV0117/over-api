<?php

namespace Tests\Feature;

use Tests\TestCase;

class StatusTest extends TestCase
{
    /**
     * @return void
     */
    public function test_if_connection_with_database_is_successfully(): void
    {
        $appVersion = env("APP_VERSION");

        $response = $this->get('api/' . $appVersion . '/status', [
            'Authorization' => env("API_KEY")
        ]);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            "message" => "OK"
        ]);
    }
}
