<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CelebsPushTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function testAddCelebsPush()
    {
        $data = [
            'send_date' => $this->faker->date('Y-m-d H:i:s'),
            'send_number' => $this->faker->randomDigit,
            'send_message' => $this->faker->text,
            'device_id' => $this->faker->sha256,
        ];

        $server = [
            'HTTP_Authorization' => 'Bearer ' . config('services.celebs_push.key')
        ];

        $response = $this->postJson(
            '/api/celebspush/add',
            $data,
            $server
        );

        $response->assertStatus(200);
        $response->assertJson(['data' => true]);

        $this->assertDatabaseHas(
            'celebs_pushes',
            [
                'send_date' => $data['send_date'],
                'send_number' => $data['send_number'],
                'send_message' => $data['send_message'],
            ]
        );
    }
}
