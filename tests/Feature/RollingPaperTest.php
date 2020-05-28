<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RollingPaperTest extends TestCase
{
    use RefreshDatabase;

    public function testPost()
    {
        $data = [
            'receiver' => str_repeat('a', 4),
            'text' => str_repeat('a', 4),
        ];

        $response = $this->post('/api/rollingpaper/wirte', $data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertDatabaseHas('rolling_paper', ['receiver' => $data['receiver'], 'note' => $data['text']]);
    }
}
